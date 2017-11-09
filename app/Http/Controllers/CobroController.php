<?php

namespace App\Http\Controllers;

use App\Http\Controllers\SociosController;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Cobro;
use App\User;
use Carbon\Carbon;

class CobroController extends Controller
{

    public function index(){
        return view('cobros.index');
    }

    public function list()
    {
        $cobro = new Cobro;

        $cobros = $cobro->select()
                  ->paginate(5);

        return view('cobros.list', compact('cobros'));
    }

    public function ListarPorUsuario($user_id)
    {
        $cobro = new Cobro;

        $cobros = $cobro->ObtenerPorCriterio('cobros.user_id', $user_id)
                    ->paginate(5);

        $user = User::find($user_id);
        
        return view('usuarios.cobros', compact('cobros', 'user'));
    }

        public function ListarPorEstado($estado_id)
    {
        $cobro = new Cobro;

        $cobros = $cobro->ObtenerPorCriterio('cobros.estado_id', $estado_id)
                    ->paginate(5);
        
        return view('cobros.list', compact('cobros'));
    }

    public function ListarPorUsuarioEstado($user_id, $estado_id)
    {
     $cobro = new Cobro;

     $cobros = $cobro->ObtenerPorUsuarioEstado($user_id, $estado_id)
                ->paginate(5);

     $user = User::find($user_id);
        
     return view('usuarios.cobros', compact('cobros', 'user'));

    }

     public function LiquidarPorEstado($estado_id)
    {
        $cobro = new Cobro;

        $cobros = $cobro->ObtenerPorCriterio('cobros.estado_id', $estado_id)
                    ->get();
        
        return view('cobros.liquidar', compact('cobros'));
    }

    public function LiquidarPorUsuarioEstado($user_id, $estado_id)
    {
     $cobro = new Cobro;

     $cobros = $cobro->ObtenerPorUsuarioEstado($user_id, $estado_id)
                ->get();
        
     return view('cobros.liquidar', compact('cobros'));

    }

    public function BuscarPorUsuario(){
        return view('cobros.buscar');
    }

    public function BuscarUsuario(Request $request)
    {
       $this->validate($request,
            [
            'Criterio' => 'required',
            'valor' => 'required|max:999999999',
            ]);

       $criterio = $request->input('Criterio');
       $valor = $request->input('valor');

       $cobro = new Cobro;

       $user = $cobro->ObtenerUsuarioPorCriterio($criterio, $valor);

       if($user)
       return redirect('/cobros/reporte/user/'.$user->id);
        else
        return back()->with('warning', 'El dato ingresado no coincide con ningún usuario');

    }

    public function ReporteCobrosDeEjecutivo($id){

        $cobro = new Cobro;

        $reporte = $cobro->ObtenerReporte($id);

        return view('cobros.cobros_ejecutivo', 
               compact('reporte'));
    }

     public function BuscarRecuento(){
        return view('cobros.recuento');
    }

    public function recuento(){

        $this->validate(request(),
            [
            'desde' => 'required|date',
            'hasta' => 'required|date',
            ]);
        
        $desde = request('desde');
        $hasta = request('hasta');
        
        return redirect('/cobros/mostrar/recuento/'.$desde.'/'.$hasta);
    }


    public function MostrarRecuento($desde, $hasta){

        $cobro = new Cobro;

        $cobros_fecha = count($cobro->ObtenerPorFecha($desde, $hasta)
                                ->get());

        if($cobros_fecha > 0){
        
        $pendientes = $cobro->ObtenerPorFechaCriterio($desde, $hasta, 'cobros.estado_id', 3);
        $pagos = $cobro->ObtenerPorFechaCriterio($desde, $hasta, 'cobros.estado_id', 4);

        $cobros_pendientes = $pendientes->count();
        $cobros_pagos = $pagos->count();

        $monto_recaudado = $pagos->sum('monto');
        $monto_sin_liquidar = $pendientes->sum('monto');

         $porcentaje_pagos = number_format(($cobros_pagos / $cobros_fecha) * 100, 2, '.', '');
         $porcentaje_pendientes = number_format(($cobros_pendientes / $cobros_fecha) * 100, 2, '.', '');

        return view('cobros.recuento_mes', compact('cobros_fecha', 'cobros_pendientes', 'porcentaje_pendientes', 'porcentaje_pagos', 'cobros_pagos', 'desde', 'hasta', 'monto_recaudado', 'monto_sin_liquidar'));
        }else
        return back()->with('warning', 'No se encontraron cobros en la fecha solicitada');
    }

    public function BuscarParaLiquidar(){
        return view('cobros.buscar_liquidar');
    }

    public function BuscarLiquidar(Request $request)
    {
       $this->validate($request,
            [
            'Criterio' => 'required',
            'valor' => 'required|max:999999999',
            ]);

       $criterio = $request->input('Criterio');
       $valor = $request->input('valor');

       $cobro = new Cobro;

       $user = $cobro->ObtenerUsuarioPorCriterio($criterio, $valor);

       if($user)
       return redirect('/cobros/liquidar/'.$user->id.'/3');
        else
            return back()->with('warning', 'El dato ingresado no coincide con ningún usuario');

    }

    public function ConsultarMorosidad(){
        return view('cobros.buscar_moroso');
    }

    public function BuscarMoroso(Request $request){

        $this->validate($request,
            [
            'Criterio' => 'required',
            'valor' => 'required|max:999999999',
            ]);

       $cobro = new Cobro;

       $criterio = $request->input('Criterio');
       $valor = $request->input('valor');

       $user = $cobro->ObtenerUsuarioPorCriterio($criterio, $valor);

       if($user!=null)
       return redirect('/cobros/usuarios/morosos/'.$user->id);
       else
        return redirect('/cobros/usuarios/morosos/consultar')->with('warning', 'No se ha encontrado al usuario');
    }

    public function MostrarMorosidadUsuario($user_id){

        $cobro = new Cobro;

        $user = $cobro->select_user()->where('users.id', $user_id)->first();

        $query = DB::table('cobros')
                            ->join('facturas', 'cobros.factura_id', 'facturas.id')
                            ->select('facturas.monto')
                            ->where('cobros.user_id', $user_id)
                            ->where('cobros.estado_id', 3);
        
        $pendientes = $query->count();
        $monto = $query->sum('monto');

        return view('cobros.morosidad_user', compact('user', 'pendientes', 'monto'));
    }

    public function ListarUsuariosMorosos(){

        $cobro = new Cobro;

        $morosos = $cobro->ObtenerUsuariosMorosos();

        return view ('cobros.morosos', compact('morosos', 'cobro'));
    }

    public function ListarPorFecha($desde, $hasta){
        $cobro = new Cobro;

        $cobros = $cobro->ObtenerPorFecha($desde, $hasta)
                    ->paginate(5);
        
        return view('cobros.list_fecha', compact('cobros', 'desde', 'hasta'));
    }

    public function ListarPorFechaEstado($desde, $hasta, $estado_id){

        $cobro = new Cobro;

        $cobros = $cobro->ObtenerPorFechaCriterio($desde, $hasta, 'cobros.estado_id', $estado_id)
                    ->paginate(5);
        
        return view('cobros.list_fecha', compact('cobros', 'desde', 'hasta'));
    }

    public function confirmar(){
        $cobro = new Cobro;

        $cobros = Input::except('_token', 'user_id');

        if($cobros){
        $user = $cobro->select()
        ->where('facturas.id', head($cobros))
        ->first();

        $monto = DB::table('cobros')
        ->join('facturas', 'cobros.factura_id', 'facturas.id')
        ->whereIn('facturas.id', $cobros)
        ->sum('facturas.monto');

        $fecha = Carbon::now()->format('Y-m-d');

        return view('cobros.confirmar', compact('cobros', 'user', 'monto', 'fecha'));
        } else{
            $user_id = request('user_id');

            return redirect('/cobros/liquidar/'.$user_id.'/3')->with('warning', 'Por favor seleccione los cobros que desea liquidar');
        }
    }

    public function liquidar(){
        $cobros = Input::except('_token');

        foreach ($cobros as $cobro) {
            DB::table('cobros')
            ->where('factura_id', $cobro)
            ->update(array('estado_id' => 4));
        }

        return view('cobros.index')->with('info', 'Operación realizada con éxito');
    }


    public function show($factura_id){
        $cobro = new Cobro;

        $cobro = $cobro->select()
                ->where('cobros.factura_id', $factura_id)
                ->first();

        return view('cobros.detail', compact('cobro'));
    }
}