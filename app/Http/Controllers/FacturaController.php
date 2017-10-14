<?php


namespace App\Http\Controllers;

use App\Http\Requests\CreateFacturaRequest;
use App\Http\Controllers\SociosController;
use App\Http\Controllers\PdfController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Factura;
use App\Socio;
use App\Cobro;
use App\Descuento;
use Carbon\Carbon;

class FacturaController extends Controller
{

    public function index(){
        return view('facturas.index');
    }

    public function buscar_socio(){
        return view('facturas.buscar_socio');
    }

    public function create(Request $request){

        $this->validate($request,
            [
            'Criterio' => 'required',
            'valor' => 'required|numeric|max:999999999',
            ],
            [
            'valor.max'=>'Solo se admiten hasta 9 digitos.',
            'valor.numeric'=>'El campo de búsqueda solo admite números.',
            ]);

        $model_factura = new Factura;
       $criterio = $request->input('Criterio');
       $valor = $request->input('valor');

       $socio = $model_factura->ObtenerSocioPorCriterio($criterio, $valor);

        if($socio != null){

            $facturas_pendientes = count($model_factura->ObtenerPorSocioEstado($socio->socio_id, 3));

                $socio = $model_factura->select_socio()
                        ->where('socios.id', $socio->socio_id)
                        ->first();

                $monto = DB::table('facturas')
                            ->where('socio_id', $socio->socio_id)
                            ->whereIn('estado_id', [3])
                            ->sum('monto');


        return view('facturas.create', compact('socio', 'facturas_pendientes', 'monto'));     
        }else{
        return redirect('/facturas/pagar/buscar')->withSuccess('El dato ingresado no corrresponde a ninguno de nuestros socios.');
        }
    }

    public function pagar(Request $request, $socio_id){

        $model_factura = new Factura;

        $meses_cancelados = request('meses_cancelados');
        $forma_pago = request('forma_pago');

        $facturas = $model_factura->select()
           ->where('facturas.socio_id', $socio_id)
           ->whereIn('facturas.estado_id', [3])
           ->limit($meses_cancelados)
           ->get();

           $model_factura->PagarPendientes($facturas, $forma_pago);

           $meses_pendientes = count($facturas);

           $meses_cancelar = $meses_cancelados - $meses_pendientes;

           if($meses_cancelados > 0)
            $model_factura->PagarAdelantado($socio_id, $meses_cancelar, $meses_cancelados, $forma_pago);

        return redirect('/facturas/index')->withSuccess('Operación exitosa');
    }

    public function ConfirmarPago($socio_id){

        $model_factura = new Factura;
        $descuento = new Descuento;

        $meses_cancelados = request('meses_cancelados');
        $user_id = Auth::user()->id;
        $fecha = Carbon::now()->format('Y-m-d');

        $user = DB::table('users')->where('users.id', $user_id)->first();

        $socio = $model_factura->select_socio()
        ->where('socios.id', $socio_id)
        ->first();

        $monto_descuento = $descuento->ObtenerMontoDescuento($socio->categoria_id, $meses_cancelados);
        $monto = $meses_cancelados*$socio->precio_categoria;

        if ($meses_cancelados == 6 || $meses_cancelados == 12) 
            $monto = $monto - ($monto_descuento*$meses_cancelados);

        $var = array('meses_cancelados' => $meses_cancelados,
            'monto' => $monto,
            'fecha_pago' => $fecha,
            'forma_pago' => request('forma_pago'),
            'nombre_usuario' => $user->nombre_usuario
            );

        return view('facturas.pago', compact('socio', 'var'));
    }

   public function edit($factura_id)
    {
        $model_factura = new Factura;

        $factura = $model_factura->select()
             ->where('facturas.id', $factura_id)
            ->first();

        return view('facturas.edit', compact('factura'));
    }

    public function GenerarFacturas(){
        
        $model_factura = new Factura;

        $socios_controller = new SociosController;
        $socios_activos = $socios_controller->sociosPorEstado(1);

        if(count($socios_activos) > 0){

            foreach ($socios_activos as $socio) {

            $facturas_pendientes = $model_factura->ObtenerPorSocioEstado($socio->id, 3);

            if(count($facturas_pendientes) == 3){

                $model_factura->InactivarSocio($socio->id);
            }
            else{

         $factura = new Factura; 
         $ultima_factura = DB::table('facturas')
                   ->where('facturas.socio_id', $socio->id)
                   ->latest()
                   ->first();    

         $categoria = $model_factura->ObtenerCategoriaDeSocio($socio);

         if($ultima_factura == null){      

         $model_factura->store($factura, $socio->id, 1, $categoria->precio_categoria, '', null, Carbon::now(), null, 3);
         }
         else{
         
         $fecha_ultima_factura = new Carbon($ultima_factura->created_at);
         $fecha_actual = Carbon::now();

         if($fecha_ultima_factura->month < $fecha_actual->month){

         $model_factura->store($factura, $socio->id, 1, $categoria->precio_categoria, '', null, Carbon::now(), null, 3);
         }
         }
            }
        }
        return redirect('/facturas/index')->withSuccess('Operación exitosa');
        } else{
        return redirect('/facturas/index')->withSuccess('No hay socios registrados en el sistema');
        }
            }

    public function update($id)
    {
        $model_factura = new Factura;
        $model_cobro = new Cobro;

    	$factura = Factura::find($id);
        $socio = Socio::find($factura->socio_id);
        $user_id = Auth::user()->id;
        $forma_pago = request('forma_pago');

        $categoria = $model_factura->ObtenerCategoriaDeSocio($socio);

        $model_factura->store($factura, $socio->id, 1, $categoria->precio_categoria, $forma_pago, null, $factura->created_at, Carbon::now(), 4);

        $model_cobro->GenerarCobroUsuario($factura->id, 3);

		 return redirect('/facturas/index')->withSuccess('Operación exitosa');
    }

    public function show($id)
    {
        $model_factura = new Factura;

        $factura = $model_factura->ObtenerPorId($id);

        return view('facturas.detail', compact('factura'));
    }

    public function list(){

        $model_factura = new Factura;
        $socios_controller = new SociosController;

        $facturas = $model_factura->select()
            ->get();

        $facturas = $socios_controller->paginate($facturas->toArray(),5);
        
        return view('facturas.list', compact('facturas'));
    }

    public function ListarPorSocio($socio_id)
    {
        $model_factura = new Factura;
        $socios_controller = new SociosController;

        $facturas = $model_factura->ObtenerPorCriterio('facturas.socio_id', $socio_id);

        $facturas = $socios_controller->paginate($facturas->toArray(),5);
        
        if(count($facturas) > 0){

            $socio = $facturas[0];

            return view('socios.facturas', compact('facturas', 'socio'));
        }
        else{
        $socio = $model_factura->select_socio()
            ->where('socios.id', $socio_id)
            ->first();

            return view('socios.facturas', compact('facturas', 'socio'));
    }
    }

        public function ListarPorEstado($estado_id)
    {
        $model_factura = new Factura;
        $socios_controller = new SociosController;

        $facturas = $model_factura->ObtenerPorCriterio('facturas.estado_id', $estado_id);

        $facturas = $socios_controller->paginate($facturas->toArray(),5);
        
        return view('facturas.list', compact('facturas'));
    }

    public function ListarPorSocioEstado($socio_id, $estado_id){

     $model_factura = new Factura;
     $socios_controller = new SociosController;

     $facturas = $model_factura->ObtenerPorSocioEstado($socio_id,$estado_id);

     $facturas = $socios_controller->paginate($facturas->toArray(),5);
        
        if(count($facturas) > 0){

            $socio = $facturas[0];

            return view('socios.facturas', compact('facturas', 'socio'));
        }
        else{
        $socio = $model_factura->select_socio()
            ->where('socios.id', $socio_id)
            ->first();

            return view('socios.facturas', compact('facturas', 'socio'));
    }

    }

    public function BuscarPorSocio(){
        return view('facturas.buscar');
    }

    public function BuscarSocio(Request $request)
    {
        $model_factura = new Factura;
       $socios_controller = new SociosController;

       $this->validate($request,
            [
            'Criterio' => 'required',
            'valor' => 'required|numeric|max:999999999',
            ],
            [
            'valor.max'=>'Solo se admiten hasta 9 digitos.',
            'valor.numeric'=>'El campo de búsqueda solo admite números.',
            ]);

       $criterio = $request->input('Criterio');
       $valor = $request->input('valor');

       $socio = $model_factura->ObtenerSocioPorCriterio($criterio, $valor);

       if($socio!=null)
       
       return redirect('/facturas/socio/'.$socio->socio_id);
       else
        return redirect('/facturas/buscar')->withSuccess('No se ha encontrado al socio');

    }

    public function BuscarRecuento(){
        return view('facturas.recuento');
    }

    public function recuento(){

         $this->validate(request(),
            [
            'desde' => 'required|date',
            'hasta' => 'required|date',
            ]);

        $desde = request('desde');
        $hasta = request('hasta');

         
        return redirect('/facturas/mostrar/recuento/'.$desde.'/'.$hasta);
    }

    public function MostrarRecuento($desde, $hasta){

        $model_factura = new Factura;

        $facturas_fecha = count($model_factura->ObtenerPorFecha($desde, $hasta));

        if($facturas_fecha > 0){
        $facturas_pendientes = count($model_factura->ObtenerPorFechaCriterio($desde, $hasta, 'facturas.estado_id', 3));
        $facturas_pagas = count($model_factura->ObtenerPorFechaCriterio($desde, $hasta, 'facturas.estado_id', 4));

        $porcentaje_pagas = number_format(($facturas_pagas / $facturas_fecha) * 100, 2, '.', '');
        $porcentaje_pendientes = number_format(($facturas_pendientes / $facturas_fecha) * 100, 2, '.', '');

            return view('facturas.recuento_mes', compact('desde', 'hasta', 'facturas_fecha', 'facturas_pendientes', 'facturas_pagas', 'porcentaje_pagas', 'porcentaje_pendientes'));
        }else{
            return redirect('/facturas/recuento')->withSuccess('No se encontraron facturas en la fecha solicitada');
        }
    }

    public function ListarPorFecha($desde, $hasta){

        $model_factura = new Factura;
        $socios_controller = new SociosController;

        $facturas = $model_factura->ObtenerPorFecha($desde, $hasta);

        $facturas = $socios_controller->paginate($facturas->toArray(),5);
        
        return view('facturas.list_fecha', compact('facturas', 'desde', 'hasta'));
    }

    public function ListarPorFechaEstado($desde, $hasta, $estado_id){

        $model_factura =  new Factura;
        $socios_controller = new SociosController;

        $facturas = $model_factura->ObtenerPorFechaCriterio($desde, $hasta, 'facturas.estado_id', $estado_id);

        $facturas = $socios_controller->paginate($facturas->toArray(),5);
        
        return view('facturas.list_fecha', compact('facturas', 'desde', 'hasta'));
    }

    public function facturas_pendientes(){

        $model_factura = new Factura;

        $facturas = $model_factura->ObtenerPorCriterio('facturas.estado_id', 3);

        $socios_controller = new SociosController;

        $facturas = $socios_controller->paginate($facturas->toArray(),5);

        return view('facturas.pendientes', compact('facturas'));
    }

    public function imprimir($id){

        $model_factura = new Factura;
        $model_cobro = new Cobro;

        $factura = Factura::find($id);
        $socio = Socio::find($factura->socio_id);
        $user_id = Auth::user()->id;
        $fecha_pago = Carbon::now();

        $categoria = $model_factura->ObtenerCategoriaDeSocio($socio);

        $model_factura->store($factura, $socio->id, 1, $categoria->precio_categoria, $factura->forma_pago, null, $factura->created_at, $fecha_pago, 4);

        $model_cobro->GenerarCobroUsuario($factura->id, 3);

         return redirect('/facturas/imprimir')->withSuccess('Operación exitosa');
    }

    public function destroy($id)
    {
    	$factura = Factura::find($id);
	    $factura->delete();

		return redirect('/');
    }
}