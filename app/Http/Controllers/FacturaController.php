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
use App\User;
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

       $factura = new Factura;
       $criterio = $request->input('Criterio');
       $valor = $request->input('valor');

       $socio = $factura->ObtenerSocioPorCriterio($criterio, $valor);

        if($socio != null){

            $facturas_pendientes = count($factura->ObtenerPorSocioEstado($socio->socio_id, 3)
                                            ->get());

                $socio = $factura->select_socio()
                        ->where('socios.id', $socio->socio_id)
                        ->first();

                $monto = DB::table('facturas')
                            ->where('socio_id', $socio->socio_id)
                            ->whereIn('estado_id', [3])
                            ->sum('monto');


        return view('facturas.create', compact('socio', 'facturas_pendientes', 'monto'));     
        }else{
        return redirect('/facturas/index')->with('warning', 'El dato ingresado no corresponde a ninguno de nuestros socios.');
        }
    }

    public function liquidar(Request $request, $socio_id){

        $factura = new Factura;

        $meses_cancelados = request('meses_cancelados');
        $forma_pago = request('forma_pago');

        $pendientes = $factura->select()
           ->where('facturas.socio_id', $socio_id)
           ->whereIn('facturas.estado_id', [3])
           ->limit($meses_cancelados)
           ->get();

           if($pendientes)
           $factura->PagarPendientes($pendientes, $socio_id, $forma_pago, $meses_cancelados);

           $numero_pendientes = count($pendientes);

           $meses_cancelar = $meses_cancelados - $numero_pendientes;

           if($meses_cancelar > 0)
            $factura->PagarAdelantado($socio_id, $meses_cancelar, $forma_pago);

        return redirect('/facturas/index')->with('info', 'Operación exitosa');
    }

    public function ConfirmarPago($socio_id){

        $factura = new Factura;
        $descuento = new Descuento;

        $meses_cancelados = request('meses_cancelados');
        $pendientes = request('pendientes');
        $user_id = Auth::user()->id;

        $user = User::find($user_id);

        $socio = $factura->select_socio()
        ->where('socios.id', $socio_id)
        ->first();

        $query = DB::table('facturas')->where('facturas.socio_id', $socio_id);

        if($pendientes)
        $ultima_factura = $query->first();
        else
        $ultima_factura = $query->latest()->first();

        if($ultima_factura)
        $pago_hasta = new Carbon($ultima_factura->periodo);
        else{
            $pago_hasta = Carbon::createFromDate(null, null, 1);
        }

        for ($i=1; $i < $meses_cancelados; $i++) { 
        $pago_hasta->addMonth();
        }

           if(!$pendientes)
            $monto_descuento = $descuento->ObtenerMontoDescuento($socio->categoria_id, $meses_cancelados); 
           else $monto_descuento = 0;

           $monto_total = $meses_cancelados*$socio->precio_categoria;
           $monto_pagar = $monto_total - ($monto_descuento*$meses_cancelados);

           $pendientes = $pendientes - $meses_cancelados;
           $periodos_pendientes = array();
           $ultimo_pago = new Carbon($pago_hasta);
           
           if($pendientes){
            for ($i=0; $i < $pendientes; $i++) { 
                
                $periodo = new Carbon($ultimo_pago->addMonth());

                $periodos_pendientes = array_add($periodos_pendientes, 
                    $i, $periodo);
            }
           }

        $var = array('meses_cancelados' => $meses_cancelados,
            'monto' => $monto_pagar,
            'fecha_pago' => Carbon::now()->format('d-m-Y'),
            'forma_pago' => request('forma_pago'),
            'nombre_usuario' => $user->nombre_usuario,
            'pago_hasta' => $pago_hasta
            );

        return view('facturas.pago', compact('socio', 'var', 'periodos_pendientes'));
    }

    public function pagar($id)
    {
        $factura = new Factura;

        $factura = $factura->select()
             ->where('facturas.id', $id)
            ->first();

        return view('facturas.pagar', compact('factura'));
    }

   public function edit($id)
    {
        $factura = new Factura;

        return view('facturas.edit', compact('factura'));
    }

    public function update($id)
    {
        $factura = new Factura;
        $cobro = new Cobro;

    	$facturaBD = Factura::find($id);
        $socio = Socio::find($facturaBD->socio_id);
        $user_id = Auth::user()->id;
        $forma_pago = request('forma_pago');

        $categoria = $factura->ObtenerCategoriaDeSocio($socio->id);

        $factura->store($facturaBD, $socio->id, 1, $categoria->precio_categoria, $forma_pago, null, $facturaBD->periodo, Carbon::now(), 4);

        $cobro->GenerarCobroUsuario($facturaBD->id, 3);

		 return redirect('/facturas/index')->with('info', 'Operación exitosa');
    }

    public function show($id)
    {
        $factura = new Factura;

        $factura = $factura->ObtenerPorId($id);

        return view('facturas.detail', compact('factura'));
    }

    public function list(){

        $factura = new Factura;

        $facturas = $factura->select()
            ->paginate(5);

        return view('facturas.list', compact('facturas'));
    }

    public function ListarPorSocio($socio_id)
    {
        $factura = new Factura;

        $facturas = $factura->ObtenerPorCriterio('facturas.socio_id', $socio_id)
                    ->paginate(5);

        $socio = $factura->select_socio()
            ->where('socios.id', $socio_id)
            ->first();

            return view('socios.facturas', compact('facturas', 'socio'));
    }

        public function ListarPorEstado($estado_id)
    {
        $factura = new Factura;

        $facturas = $factura->ObtenerPorCriterio('facturas.estado_id', $estado_id)
                    ->paginate(5);
        
        return view('facturas.list', compact('facturas'));
    }

    public function ListarPorSocioEstado($socio_id, $estado_id){

     $factura = new Factura;

     $facturas = $factura->ObtenerPorSocioEstado($socio_id,$estado_id)
                 ->paginate(5);
        
     $socio = $factura->select_socio()
            ->where('socios.id', $socio_id)
            ->first();

            return view('socios.facturas', compact('facturas', 'socio'));
    }

    public function ListarPendientesSocio($socio_id, $estado_id){

     $factura = new Factura;

     $facturas = $factura->ObtenerPorSocioEstado($socio_id, $estado_id)
                 ->paginate(5);
    
     $socio = $factura->select_socio()
            ->where('socios.id', $socio_id)
            ->first();

            return view('socios.facturas_pendientes', compact('facturas', 'socio'));
    }

    public function BuscarPorSocio(){
        return view('facturas.buscar');
    }

    public function BuscarSocio(Request $request){
        $factura = new Factura;

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

       $socio = $factura->ObtenerSocioPorCriterio($criterio, $valor);

       if($socio!=null)
       
       return redirect('/facturas/socio/'.$socio->socio_id);
       else
        return redirect('/facturas/index')->with('warning', 'No se ha encontrado al socio');

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

        $factura = new Factura;

        $facturas_fecha = $factura->ObtenerPorFecha($desde, $hasta)->count();

        if($facturas_fecha > 0){
        $facturas_pendientes = $factura->ObtenerPorFechaCriterio($desde, $hasta, 'facturas.estado_id', 3)->count();
        $facturas_pagas = $factura->ObtenerPorFechaCriterio($desde, $hasta, 'facturas.estado_id', 4)->count();

        $porcentaje_pagas = number_format(($facturas_pagas / $facturas_fecha) * 100, 2, '.', '');
        $porcentaje_pendientes = number_format(($facturas_pendientes / $facturas_fecha) * 100, 2, '.', '');

            return view('facturas.recuento_mes', compact('desde', 'hasta', 'facturas_fecha', 'facturas_pendientes', 'facturas_pagas', 'porcentaje_pagas', 'porcentaje_pendientes'));
        }else{
            return redirect('/facturas/recuento')->with('warning', 'No se encontraron facturas en la fecha solicitada');
        }
    }

    public function ConsultarMorosidad(){
        return view('facturas.buscar_moroso');
    }

    public function BuscarMoroso(Request $request){

        $this->validate($request,
            [
            'Criterio' => 'required',
            'valor' => 'required|numeric|max:999999999',
            ],
            [
            'valor.max'=>'Solo se admiten hasta 9 digitos.',
            'valor.numeric'=>'El campo de búsqueda solo admite números.',
            ]);
        $factura = new Factura;

       $criterio = $request->input('Criterio');
       $valor = $request->input('valor');

       $socio = $factura->ObtenerSocioPorCriterio($criterio, $valor);

       if($socio!=null)
       return redirect('/facturas/socios/morosos/'.$socio->socio_id);
       else
        return redirect('/facturas/index')->with('warning', 'No se ha encontrado al socio');
    }

    public function MostrarMorosidadSocio($socio_id){

        $factura = new Factura;

        $socio = $factura->select_socio()->where('socios.id', $socio_id)->first();

        $query = DB::table('facturas')
                            ->where('facturas.socio_id', $socio_id)
                            ->where('facturas.estado_id', 3);
        
        $pendientes = $query->get();
        $monto = $query->sum('monto');

        return view('facturas.morosidad_socio', compact('socio', 'pendientes', 'monto'));
    }

     public function ListarSociosMorosos(){

        $factura = new Factura;

        $morosos = $factura->ObtenerSociosMorosos();

        return view ('facturas.morosos', compact('morosos', 'factura'));
    }

    public function ListarPorFecha($desde, $hasta){

        $factura = new Factura;

        $facturas = $factura->ObtenerPorFecha($desde, $hasta)
                    ->paginate(5);
        
        return view('facturas.list_fecha', compact('facturas', 'desde', 'hasta'));
    }

    public function ListarPorFechaEstado($desde, $hasta, $estado_id){

        $factura =  new Factura;

        $facturas = $factura->ObtenerPorFechaCriterio($desde, $hasta, 'facturas.estado_id', $estado_id)
                    ->paginate(5);
        
        return view('facturas.list_fecha', compact('facturas', 'desde', 'hasta'));
    }

    public function facturas_pendientes(){

        $factura = new Factura;

        $facturas = $factura->ObtenerPorCriterio('facturas.estado_id', 3)
                    ->paginate(5);

        return view('facturas.pendientes', compact('facturas'));
    }

    public function imprimir($id){

        $factura = new Factura;
        $cobro = new Cobro;

        $factura = Factura::find($id);
        $socio = Socio::find($factura->socio_id);
        $user_id = Auth::user()->id;
        $fecha_pago = Carbon::now();

        $categoria = $factura->ObtenerCategoriaDeSocio($socio);

        $factura->store($factura, $socio->id, 1, $categoria->precio_categoria, $factura->forma_pago, null, $factura->periodo, $fecha_pago, 4);

        $cobro->GenerarCobroUsuario($factura->id, 3);

         return redirect('/facturas/imprimir')->with('info', 'Operación exitosa');
    }

    public function destroy($id)
    {
    	$factura = Factura::find($id);
	    $factura->delete();

		return redirect('/');
    }
}