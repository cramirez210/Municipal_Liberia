<?php

namespace App\Http\Controllers;

use App\Factura;
use App\Http\Controllers\SociosController;
use App\Http\Controllers\UsuariosController;
use App\Persona;
use App\Socio;
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
    	$tipoReporte = 'Socio sdel Usuarios '.$usuario[0]->primer_nombre." ".$usuario[0]->primer_apellido." ".$usuario[0]->segundo_apellido;
    	$hora = Carbon::now();
    	if (count($listas)) {
    		return view('/reportes/tiposReportes/reporteSocios',compact('listas','tipoReporte','hora'));
    	} else {
    		return redirect('/reportes/index')->with('info','No se encontro ningun resultado evaluado el criterio de busqueda');
    	}
    	
    }


     public function todosLosSocios()
    {   
        $listas = $this->consultarSocios()->orderBy('id_categoria')->get();
        $tipoReporte = 'Todos los socios.';
        $hora = Carbon::now();
        return view('/reportes/tiposReportes/reporteSocios',compact('listas','tipoReporte','hora'));
    }

    public function consultarSocios()
    {
        return DB::table('socios')
            ->join('personas', 'socios.persona_id', '=', 'personas.id')
            ->join('categorias','socios.categoria_id', '=', 'categorias.id')
            ->join('estados','socios.estado_id', '=', 'estados.id')
            ->select('personas.*', 'socios.*','estados.estado','categorias.*','categorias.categoria','categorias.id as id_categoria');
    }

     public function sociosActividad($id)
    {   

       // $listas = Socio::where("estado_id","=",$id)->latest()->orderBy('created_at')->get();

        $listas = $this->consultarActividad($id)->orderBy('id_categoria')->get();
    
        if ($id==1) 
             $tipoReporte = 'Socios activos.';
        else
             $tipoReporte = 'Socios inactivos.';
       
        $hora = Carbon::now();

        return view('/reportes/tiposReportes/reporteSocios',compact('listas','tipoReporte','hora'));
    }

    public function consultarActividad($id)
    {
        return DB::table('socios')
            ->join('personas', 'socios.persona_id', '=', 'personas.id')
            ->join('categorias','socios.categoria_id', '=', 'categorias.id')
            ->join('estados','socios.estado_id', '=', 'estados.id')
            ->select('personas.*', 'socios.*','estados.estado','categorias.*','categorias.categoria','categorias.id as id_categoria')
            ->where('socios.estado_id',$id);
    }

    public function morocidadSocios()
    {
    	$DB = new Factura;

    	$listas = $DB->ObtenerSociosMorosos();
        $tipoReporte = 'Todos los socios morosos';
        $hora = Carbon::now();
        if (count($listas)) {
        	return view('/reportes/tiposReportes/reporteSocios',compact('listas','tipoReporte','hora'));
        } else {
        	return redirect('/reportes/index')->with('warning','No se encontro ningun resultado evaluado el criterio de busqueda');
        }
    }

    public function factura(Request $request)
    {
    	//dd($request->all());
    	if(is_numeric($request->input('valor')))
    	{
    		
	    	$DB = new Factura;

	    	$listas = $DB->ObtenerPorId($request->input('valor'));
	        $tipoReporte = 'Todos los socios morosos';
	        $hora = Carbon::now();

	        if ($listas!=null) {
	        	return view('/reportes/tiposReportes/reporteFactura',compact('listas','tipoReporte','hora'));
	        } else {
	        	return redirect('/reportes/index')->with('warning','No se encontro ningun resultado evaluado el criterio de busqueda');
	        } 
    	}else{
    		return redirect('/reportes/index')->with('warning','El campo Numero Factura solo acepta numeros.');
    	}

    	
    }

}
