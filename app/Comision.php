<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\User;

class Comision extends Model
{
        protected $fillable = [
        'desde', 'hasta', 'monto', 'comision',
    ];


    public function select()
    {

    return DB::table('comisions')
            ->join('users', 'comisions.user_id', 'users.id')
            ->join('personas', 'users.persona_id', 'personas.id')
            ->select('users.nombre_usuario', 'personas.*', 'personas.id as persona_id', 'comisions.*');	
    }

    public function ObtenerPorFecha($desde, $hasta){

    	$comisiones = $this->select()
    				->whereBetween('comisions.created_at', array($desde, $hasta));

    	return $comisiones;
    }

    public function ObtenerPorUser($user_id){

    	$comisiones = $this->select()
    				->where('users.id', $user_id);

    	return $comisiones;
    }

    public function ObtenerPorFechaUser($user_id, $desde, $hasta){

    	$comisiones = $this->select()
    				->where('users.id', $user_id)
    				->whereBetween('comisions.created_at', array($desde, $hasta));

    	return $comisiones;
    }

    public function ObtenerUsuarioPorCriterio($criterio, $valor){
        if($criterio == 1){
            $user = DB::table('users')
            ->join('personas', 'users.persona_id', '=', 'personas.id')
            ->select('users.id', 'personas.primer_nombre', 'personas.primer_apellido', 'personas.segundo_apellido')
            ->where('personas.cedula', $valor)
            ->first();
        }else{
            $user = DB::table('users')
            ->join('personas', 'users.persona_id', '=', 'personas.id')
            ->select('users.id', 'personas.primer_nombre', 'personas.primer_apellido', 'personas.segundo_apellido')
            ->where('users.nombre_usuario', $valor)
            ->first();
        }

        return $user;
    }
}
