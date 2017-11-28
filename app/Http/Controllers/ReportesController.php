<?php

namespace App\Http\Controllers;

use App\Factura;
use App\Cobro;
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

    public function facturasFechas(){

        $this->validate(request(),
            [
            'desde' => 'required|date',
            'hasta' => 'required|date',
            ]);

        $desde = request('desde');
        $hasta = request('hasta');

        $factura = new Factura;

        $facturas = $factura->ObtenerPorFecha($desde, $hasta)->get();

        $tipoReporte = 'Facturas desde '.$desde.' hasta '.$hasta;
        $hora = Carbon::now();

        if (count($facturas)) {
            return view('reportes.tiposReportes.reporteFacturas', compact('facturas', 'tipoReporte', 'hora'));
        } else {
            return redirect('/reportes/index')->with('info','No se encontraron facturas en las fechas indicadas');
        }
    }

    public function facturasPendientes(){

        $factura = new Factura;

        $facturas = $factura->ObtenerPorCriterio('facturas.estado_id', 3)->get();

        $tipoReporte = 'Todas las facturas pendientes';
        $hora = Carbon::now();

        if (count($facturas)) {
            return view('reportes.tiposReportes.reporteFacturas', compact('facturas', 'tipoReporte', 'hora'));
        } else {
            return redirect('/reportes/index')->with('info','No se encontraron facturas pendientes');
        }

    }

        public function cobrosFechas(){

        $this->validate(request(),
            [
            'desde' => 'required|date',
            'hasta' => 'required|date',
            ]);

        $desde = request('desde');
        $hasta = request('hasta');

        $cobro = new Cobro;

        $cobros = $cobro->ObtenerPorFecha($desde, $hasta)->get();

        $tipoReporte = 'Cobros desde '.$desde.' hasta '.$hasta;
        $hora = Carbon::now();

        if (count($cobros)) {
           return view('reportes.tiposReportes.reporteCobros', compact('cobros', 'tipoReporte', 'hora'));
        } else {
            return redirect('/reportes/index')->with('info','No se encontraron cobros en las fechas indicadas');
        }

    }

     public function cobrosPendientes(){

        $cobro = new Cobro;

        $cobros = $cobro->ObtenerPorCriterio('cobros.estado_id', 3)->get();

        $tipoReporte = 'Todos los cobros pendientes';
        $hora = Carbon::now();

         if (count($cobros)) {
            return view('reportes.tiposReportes.reporteCobros', compact('cobros', 'tipoReporte', 'hora'));
        } else {
            return redirect('/reportes/index')->with('info','No se encontraron cobros pendientes');
        }

    }

     public function cobrosLiquidados(){

        $cobro = new Cobro;

        $cobros = $cobro->ObtenerPorCriterio('cobros.estado_id', 4)->get();

        $tipoReporte = 'Todos los cobros liquidados';
        $hora = Carbon::now();


        if (count($cobros)) {
           return view('reportes.tiposReportes.reporteCobros', compact('cobros', 'tipoReporte', 'hora'));
        } else {
            return redirect('/reportes/index')->with('info','No se encontraron cobros liquidados');
        }
    }

    public function morocidadUsuarios()
    {
        $DB = new Cobro;

        $morosos = $DB->ObtenerUsuariosMorosos();
        $tipoReporte = 'Todos los usuarios morosos';
        $hora = Carbon::now();

        if (count($morosos)) {
           return view('reportes.tiposReportes.reporteUsuariosMorosos', 
                        compact('morosos', 'tipoReporte', 'hora', 'DB'));
        } else {
            return redirect('/reportes/index')->with('info','No se encontraron usuarios morosos');
        }
        
    }

    public function morocidadUsuario(){
       $criterio = request('Criterio');
       $valor = request('valor');

       $cobro = new Cobro;

       $user = $cobro->ObtenerUsuarioPorCriterio($criterio, $valor);

       if($user){
        $user = $cobro->select_user()->where('users.id', $user->id)->first();

        $cobros = $cobro->ObtenerPorUsuarioEstado($user->id, 3)->get();
        $tipoReporte = 'Cobros pendientes del usuario '.$user->primer_nombre.' '.$user->primer_apellido.' '.$user->segundo_apellido;
        $hora = Carbon::now();

        if (count($cobros)) {
          return view('reportes.tiposReportes.reporteUsuarioMoroso', compact('cobros', 'tipoReporte', 'hora'));
        } else {
            return redirect('/reportes/index')
                    ->with('info','No se encontraron cobros pendientes para el usuario '.$user->primer_nombre.' '.$user->primer_apellido.' '.$user->segundo_apellido);
        }
    }else 
       return redirect('/reportes/index')->with('warning','El valor ingresado no coincide con ningún usuario.');


}

}