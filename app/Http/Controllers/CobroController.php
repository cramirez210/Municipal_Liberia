<?php

namespace App\Http\Controllers;

use App\Http\Controllers\SociosController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Cobro;

class CobroController extends Controller
{
    //
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
            ->select('users.id as user_id', 'personas.primer_nombre', 'personas.primer_apellido', 'personas.segundo_apellido', 'facturas.id as factura_id', 'facturas.monto', 'cobros.id', 'cobros.created_at', 'estados.id as estado_id', 'estados.estado')
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
            ->select('users.id as user_id', 'personas.primer_nombre', 'personas.primer_apellido', 'personas.segundo_apellido', 'facturas.id as factura_id', 'facturas.monto', 'cobros.id', 'cobros.created_at', 'estados.id as estado_id', 'estados.estado')
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
            ->select('users.id as user_id', 'personas.primer_nombre', 'personas.primer_apellido', 'personas.segundo_apellido', 'facturas.id as factura_id', 'facturas.monto', 'cobros.id', 'cobros.created_at', 'estados.id as estado_id', 'estados.estado')
            ->get();

        $cobros = $this->paginar($cobros);
        
        return view('cobros.list', compact('cobros'));
    }

    public function ListarPorUsuario($user_id)
    {
        $cobros = $this->ObtenerPorCriterio('cobros.user_id', $user_id);

        $cobros = $this->paginar($cobros);
        
        return view('cobros.list', compact('cobros'));
    }

        public function ListarPorEstado($estado_id)
    {
        $cobros = $this->ObtenerPorCriterio('cobros.estado_id', $estado_id);

        $cobros = $this->paginar($cobros);
        
        return view('cobros.list', compact('cobros'));
    }

    public function ListarPorUsuarioEstado($user_id, $estado_id){

     $cobros = $this->ObtenerPorUsuarioEstado($user_id, $estado_id);

     $cobros = $this->paginar($cobros);
        
     return view('cobros.list', compact('cobros'));

    }

    public function paginar($cobros){
    	$socios_controller = new SociosController;

    	$cobros = $socios_controller->paginate($cobros->toArray(),5);

    	return $cobros;
    }
}
