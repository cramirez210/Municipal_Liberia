<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\SociosController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Cobro extends Model
{
    //
    protected $guarded = [];

    public function GenerarCobroUsuario($factura_id, $estado_id){

        $user_id = Auth::user()->id;

        $cobro = new Cobro;

        $cobro->user_id = $user_id;
        $cobro->factura_id = $factura_id;
        $cobro->estado_id = $estado_id;

        $cobro->save();
    }

    public function select()
    {

    return DB::table('cobros')
            ->join('users', 'cobros.user_id', '=', 'users.id')
            ->join('personas', 'users.persona_id', '=', 'personas.id')
            ->join('facturas', 'cobros.factura_id', '=', 'facturas.id')
            ->join('estados', 'cobros.estado_id', '=', 'estados.id')
            ->select('users.id as user_id', 'users.nombre_usuario', 'personas.cedula', 'personas.primer_nombre', 'personas.primer_apellido', 'personas.segundo_apellido', 'facturas.id as factura_id', 'facturas.monto', 'facturas.forma_pago', 'facturas.created_at as fecha_factura', 'cobros.id', 'cobros.created_at', 'estados.id as estado_id', 'estados.estado');	
    }

    public function ObtenerPorCriterio($columna, $valor)
    {
            $cobros = $this->select()
            ->where($columna, $valor)
            ->get();

        return $cobros;
    }

    public function ObtenerPorUsuarioEstado($user_id, $estado_id){
    	$cobros = $this->select()
            ->where('cobros.user_id', $user_id)
            ->whereIn('cobros.estado_id', [$estado_id])
            ->get();

        return $cobros;
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

    public function ObtenerPorFecha($fecha_inicio, $fecha_fin){
     $cobros = $this->select()
            ->whereBetween('cobros.created_at', array($fecha_inicio, $fecha_fin))
            ->get();

        return $cobros;   
    }

    public function ObtenerPorFechaCriterio($fecha_inicio, $fecha_fin, $columna, $valor){
     $cobros = $this->select()
            ->whereBetween('cobros.created_at', array($fecha_inicio, $fecha_fin))
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
