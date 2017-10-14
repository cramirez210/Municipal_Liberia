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
        $model_cobro = new Cobro;

        $cobros = $model_cobro->select()
                  ->get();

        $cobros = $model_cobro->paginar($cobros);

        return view('cobros.list', compact('cobros'));
    }

    public function ListarPorUsuario($user_id)
    {
        $model_cobro = new Cobro;

        $cobros = $model_cobro->ObtenerPorCriterio('cobros.user_id', $user_id);

        if(count($cobros))
        $user = $cobros[0];
        else
        $user = User::find($user_id);

        $cobros = $model_cobro->paginar($cobros);
        
        return view('usuarios.cobros', compact('cobros', 'user'));
    }

        public function ListarPorEstado($estado_id)
    {
        $model_cobro = new Cobro;

        $cobros = $model_cobro->ObtenerPorCriterio('cobros.estado_id', $estado_id);

        $cobros = $model_cobro->paginar($cobros);
        
        return view('cobros.list', compact('cobros'));
    }

    public function ListarPorUsuarioEstado($user_id, $estado_id)
    {
     $model_cobro = new Cobro;

     $cobros = $model_cobro->ObtenerPorUsuarioEstado($user_id, $estado_id);

     if(count($cobros))
        $user = $cobros[0];
        else
        $user = DB::table('users')
                ->select('users.id as user_id', 'users.nombre_usuario')
                ->where('users.id', $user_id)
                ->first();

     $cobros = $model_cobro->paginar($cobros);
        
     return view('usuarios.cobros', compact('cobros', 'user'));

    }

     public function AnularPorEstado($estado_id)
    {
        $model_cobro = new Cobro;

        $cobros = $model_cobro->ObtenerPorCriterio('cobros.estado_id', $estado_id);
        
        return view('cobros.anular', compact('cobros'));
    }

    public function AnularPorUsuarioEstado($user_id, $estado_id)
    {
     $model_cobro = new Cobro;

     $cobros = $model_cobro->ObtenerPorUsuarioEstado($user_id, $estado_id);
        
     return view('cobros.anular', compact('cobros'));

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

       $model_cobro = new Cobro;

       $user = $model_cobro->ObtenerUsuarioPorCriterio($criterio, $valor);

       if($user)
       return redirect('/cobros/user/'.$user->id);
        else
        return back()->withSuccess('El dato ingresado no coincide con ningún usuario');

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

        $model_cobro = new Cobro;

        $cobros_fecha = count($model_cobro->ObtenerPorFecha($desde, $hasta));

        if($cobros_fecha > 0){
         $cobros_pendientes = count($model_cobro->ObtenerPorFechaCriterio($desde, $hasta, 'facturas.estado_id', 3));
         $cobros_pagos = count($model_cobro->ObtenerPorFechaCriterio($desde, $hasta, 'facturas.estado_id', 4));

         $porcentaje_pagos = number_format(($cobros_pagos / $cobros_fecha) * 100, 2, '.', '');
         $porcentaje_pendientes = number_format(($cobros_pendientes / $cobros_fecha) * 100, 2, '.', '');

        return view('cobros.recuento_mes', compact('cobros_fecha', 'cobros_pendientes', 'porcentaje_pendientes', 'porcentaje_pagos', 'cobros_pagos', 'desde', 'hasta'));
        }else
        return back()->withSuccess('No se encontraron cobros en la fecha solicitada');
    }

    public function BuscarParaAnular(){
        return view('cobros.buscar_anular');
    }

    public function BuscarAnular(Request $request)
    {
       $this->validate($request,
            [
            'Criterio' => 'required',
            'valor' => 'required|max:999999999',
            ]);

       $criterio = $request->input('Criterio');
       $valor = $request->input('valor');

       $model_cobro = new Cobro;

       $user = $model_cobro->ObtenerUsuarioPorCriterio($criterio, $valor);

       if($user)
       return redirect('/cobros/anular/'.$user->id.'/3');
        else
            return back()->withSuccess('El dato ingresado no coincide con ningún usuario');

    }

    public function ListarPorFecha($desde, $hasta){
        $model_cobro = new Cobro;

        $cobros = $model_cobro->ObtenerPorFecha($desde, $hasta);

        $cobros = $model_cobro->paginar($cobros);
        
        return view('cobros.list_fecha', compact('cobros', 'desde', 'hasta'));
    }

    public function ListarPorFechaEstado($desde, $hasta, $estado_id){

        $model_cobro = new Cobro;

        $cobros = $model_cobro->ObtenerPorFechaCriterio($desde, $hasta, 'facturas.estado_id', $estado_id);

        $cobros = $model_cobro->paginar($cobros);
        
        return view('cobros.list_fecha', compact('cobros', 'desde', 'hasta'));
    }

    public function confirmar(){
        $model_cobro = new Cobro;

        $cobros = Input::except('_token', 'user_id');

        if($cobros){
        $user = $model_cobro->select()
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

            return redirect('/cobros/anular/'.$user_id.'/3')->withSuccess('Por favor seleccione los cobros que desea anular');
        }
    }

    public function anular(){
        $cobros = Input::except('_token');

        foreach ($cobros as $cobro) {
            DB::table('cobros')
            ->where('factura_id', $cobro)
            ->update(array('estado_id' => 4));
        }

        return view('cobros.index')->withSuccess('Éxito');
    }


    public function show($id){
        $model_cobro = new Cobro;

        $cobro = $model_cobro->select()
                ->where('cobros.id', $id)
                ->first();

        return view('cobros.detail', compact('cobro'));
    }
}