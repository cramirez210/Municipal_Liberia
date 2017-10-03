<?php

namespace App\Http\Controllers;

use App\Http\Controllers\SociosController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Cobro;

class CobroController extends Controller
{

    public function index(){
        return view('cobros.index');
    }

    public function GenerarCobroUsuario($factura_id, $estado_id){

        $user_id = Auth::user()->id;

        $cobro = new Cobro;

        $cobro->user_id = $user_id;
        $cobro->factura_id = $factura_id;
        $cobro->estado_id = $estado_id;

        $cobro->save();
    }

    public function ObtenerPorCriterio($columna, $valor)
    {
            $cobros = DB::table('cobros')
            ->join('users', 'cobros.user_id', '=', 'users.id')
            ->join('personas', 'users.persona_id', '=', 'personas.id')
            ->join('facturas', 'cobros.factura_id', '=', 'facturas.id')
            ->join('estados', 'cobros.estado_id', '=', 'estados.id')
            ->select('users.id as user_id', 'users.nombre_usuario', 'personas.primer_nombre', 'personas.primer_apellido', 'personas.segundo_apellido', 'facturas.id as factura_id', 'facturas.monto', 'cobros.id', 'cobros.created_at', 'estados.id as estado_id', 'estados.estado')
            ->where($columna, $valor)
            ->get();

        return $cobros;
    }

    public function ObtenerPorUsuarioEstado($user_id, $estado_id){
    	$cobros = DB::table('cobros')
            ->join('users', 'cobros.user_id', '=', 'users.id')
            ->join('personas', 'users.persona_id', '=', 'personas.id')
            ->join('facturas', 'cobros.factura_id', '=', 'facturas.id')
            ->join('estados', 'cobros.estado_id', '=', 'estados.id')
            ->select('users.id as user_id', 'users.nombre_usuario', 'personas.primer_nombre', 'personas.primer_apellido', 'personas.segundo_apellido', 'facturas.id as factura_id', 'facturas.monto', 'cobros.id', 'cobros.created_at', 'estados.id as estado_id', 'estados.estado')
            ->where('cobros.user_id', $user_id)
            ->whereIn('cobros.estado_id', [$estado_id])
            ->get();

        return $cobros;
    }

    public function list()
    {
        $cobros = DB::table('cobros')
            ->join('users', 'cobros.user_id', '=', 'users.id')
            ->join('personas', 'users.persona_id', '=', 'personas.id')
            ->join('facturas', 'cobros.factura_id', '=', 'facturas.id')
            ->join('estados', 'cobros.estado_id', '=', 'estados.id')
            ->select('users.id as user_id', 'users.nombre_usuario', 'personas.primer_nombre', 'personas.primer_apellido', 'personas.segundo_apellido', 'facturas.id as factura_id', 'facturas.monto', 'cobros.id', 'cobros.created_at', 'estados.id as estado_id', 'estados.estado')
            ->get();

        $cobros = $this->paginar($cobros);

        return view('cobros.list', compact('cobros'));
    }

    public function ListarPorUsuario($user_id)
    {
        $cobros = $this->ObtenerPorCriterio('cobros.user_id', $user_id);

        $user = $cobros[0];

        $cobros = $this->paginar($cobros);
        
        return view('usuarios.cobros', compact('cobros', 'user'));
    }

        public function ListarPorEstado($estado_id)
    {
        $cobros = $this->ObtenerPorCriterio('cobros.estado_id', $estado_id);

        $cobros = $this->paginar($cobros);
        
        return view('cobros.list', compact('cobros'));
    }

    public function ListarPorUsuarioEstado($user_id, $estado_id){

     $cobros = $this->ObtenerPorUsuarioEstado($user_id, $estado_id);

     $user = $cobros[0];

     $cobros = $this->paginar($cobros);
        
     return view('usuarios.cobros', compact('cobros', 'user'));

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

       $user = $this->ObtenerUsuarioPorCriterio($criterio, $valor);

       return $this->ListarPorUsuario($user->id);

    }

    public function ObtenerUsuarioPorCriterio($criterio, $valor){
        if($criterio == 1){
            $user = DB::table('users')
            ->join('personas', 'users.persona_id', '=', 'personas.id')
            ->select('users.id')
            ->where('personas.cedula', $valor)
            ->first();
        }else{
            $user = DB::table('users')
            ->select('users.id')
            ->where('users.nombre_usuario', $valor)
            ->first();
        }

        return $user;
    }

     public function BuscarRecuento(){
        return view('cobros.recuento');
    }

    public function recuento(){
        $mes = request('mes');
        $anio = request('anio');

        $cobros_fecha = count($this->ObtenerPorFecha($mes, $anio));
        $cobros_pendientes = count($this->ObtenerPorFechaCriterio($mes, $anio, 'facturas.estado_id', 3));
        $cobros_pagos = count($this->ObtenerPorFechaCriterio($mes, $anio, 'facturas.estado_id', 4));

        return view('cobros.recuento_mes', compact('cobros_fecha', 'cobros_pendientes', 'cobros_pagos', 'mes', 'anio'));
    }

    public function ListarPorFecha($mes, $anio){

        $socios_controller = new SociosController;

        $cobros = $this->ObtenerPorFecha($mes, $anio);

        $cobros = $socios_controller->paginate($cobros->toArray(),5);
        
        return view('cobros.list', compact('cobros'));
    }

    public function ListarPorFechaEstado($mes, $anio, $estado_id){

        $socios_controller = new SociosController;

        $cobros = $this->ObtenerPorFechaCriterio($mes, $anio, 'facturas.estado_id', $estado_id);

        $cobros = $socios_controller->paginate($cobros->toArray(),5);
        
        return view('cobros.list', compact('cobros'));
    }

    public function ObtenerPorFecha($mes, $anio){
     $cobros = DB::table('cobros')
            ->join('users', 'cobros.user_id', '=', 'users.id')
            ->join('personas', 'users.persona_id', '=', 'personas.id')
            ->join('facturas', 'cobros.factura_id', '=', 'facturas.id')
            ->join('estados', 'cobros.estado_id', '=', 'estados.id')
            ->select('users.id as user_id', 'users.nombre_usuario', 'personas.primer_nombre', 'personas.primer_apellido', 'personas.segundo_apellido', 'facturas.id as factura_id', 'facturas.monto', 'cobros.id', 'cobros.created_at', 'estados.id as estado_id', 'estados.estado')
            ->whereMonth('cobros.created_at', $mes)
            ->whereYear('cobros.created_at', $anio)
            ->get();

        return $cobros;   
    }

    public function ObtenerPorFechaCriterio($mes, $anio, $columna, $valor){
     $cobros = DB::table('cobros')
            ->join('users', 'cobros.user_id', '=', 'users.id')
            ->join('personas', 'users.persona_id', '=', 'personas.id')
            ->join('facturas', 'cobros.factura_id', '=', 'facturas.id')
            ->join('estados', 'cobros.estado_id', '=', 'estados.id')
            ->select('users.id as user_id', 'users.nombre_usuario', 'personas.primer_nombre', 'personas.primer_apellido', 'personas.segundo_apellido', 'facturas.id as factura_id', 'facturas.monto', 'cobros.id', 'cobros.created_at', 'estados.id as estado_id', 'estados.estado')
            ->whereMonth('cobros.created_at', $mes)
            ->whereYear('cobros.created_at', $anio)
            ->where($columna, $valor)
            ->get();

        return $cobros;   
    }

    public function paginar($cobros){
    	$socios_controller = new SociosController;

    	$cobros = $socios_controller->paginate($cobros->toArray(),5);

    	return $cobros;
    }
}
