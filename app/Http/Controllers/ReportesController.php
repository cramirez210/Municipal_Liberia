<?php

namespace App\Http\Controllers;

use App\Http\Controllers\SociosController;
use App\Http\Controllers\UsuariosController;
use App\Persona;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportesController extends Controller
{
    public function index()
    {
        return view('/reportes/index');
    }

    public function home()
    {
        return view('/reportes/reporte');
    }

    public function allUsuario()
    {   
    	$listas = $this->consultaUsuarios()->orderBy('rolId', 'asc')->get();
    	$tipoReporte = 'Todos los Usuarios.';
    	$hora = Carbon::now();
    	return view('/reportes/tiposReportes/reporteUsuarios',compact('listas','tipoReporte','hora'));
    }

    public function consultaUsuarios()
    {
    	return DB::table('users')
            ->join('personas', 'users.persona_id', '=', 'personas.id')
            ->join('roles','users.rol_id', '=', 'roles.id')
            ->join('estados','users.estado_id', '=', 'estados.id')
            ->select('personas.*', 'users.*','estados.estado','roles.*','roles.rol','roles.id as rolId');
    }

    public function estadoUsuarios($id)
    {
    	if ($id == 1) {
 			$tipo = 'activo';
 		} else {
 			$tipo = 'inactivo';
 		}
    	$listas = $this->consultaUsuarios()->where('users.estado_id',$id)->orderBy('rolId', 'asc')->get();
 		$tipoReporte = 'Usuarios por estado '.$tipo;
    	$hora = Carbon::now();
    	return view('/reportes/tiposReportes/reporteUsuarios',compact('listas','tipoReporte','hora'));	
    }

    public function sociosByUsuario(Request $request)
    {	
    	$usuario = UsuariosController::obtenerUsuarioPorCriterio($request->input('Criterio'), $request->input('valor'));
    	//dd($usuario->all());
    	$listas = SociosController::sociosPorUsuarioId($usuario[0]->id);
    	$tipoReporte = 'Socios del Usuarios '.$usuario[0]->primer_nombre." ".$usuario[0]->primer_apellido." ".$usuario[0]->segundo_apellido;
    	$hora = Carbon::now();
    	if (count($listas)) {
    		return view('/reportes/tiposReportes/reporteSocios',compact('listas','tipoReporte','hora'));
    	} else {
    		return redirect('/reportes/index')->with('info','No se encontro ningun resultado evaluado el criterio de busqueda');
    	}
    	
    	
    }

}
