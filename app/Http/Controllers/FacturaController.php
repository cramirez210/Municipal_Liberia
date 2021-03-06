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
use PDF;
use App\Http\Controllers\CorreoController;

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

          $facturas_imprimir = $factura->select()->orderBy('facturas.id', 'desc')
                    ->where('facturas.socio_id', $socio_id)->where('facturas.estado_id', 4)
                    ->limit($meses_cancelados)->get();

          $hora = Carbon::now();

           return view('facturas.imprimir_facturas_pago', compact('facturas_imprimir', 'hora'));
    }

    public function ConfirmarPago($socio_id){

        $factura = new Factura;
        $descuento = new Descuento;

        $meses_cancelados = request('meses_cancelados');
        $pendientes = request('pendientes');
        $user_id = Auth::user()->id;

        $user = User::find($user_id);

        $socio = $factura->select_socio()
        ->where('socios.id', $socio_id)->first();

        $query = DB::table('facturas')->where('facturas.socio_id', $socio_id);

        $numero_pendientes = DB::table('facturas')->where('facturas.socio_id', $socio_id)
                            ->where('estado_id', 3)->count();

        if ($numero_pendientes >= 2) {
            $ultima_factura = $query->orderBy('periodo', 'asc')->first();
        }else {
            $ultima_factura = $query->orderBy('periodo', 'desc')->first();
        }

        $pago_hasta = $this->CalcularUltimoPago($ultima_factura, $meses_cancelados);

           if(!$pendientes)
            $monto_descuento = $descuento->ObtenerMontoDescuento($socio->categoria_id, $meses_cancelados); 
           else $monto_descuento = 0;

           $monto_total = $meses_cancelados*$socio->precio_categoria;

           if($meses_cancelados == 6 || $meses_cancelados == 12)
           $monto_pagar = $monto_total - ($monto_descuento*$meses_cancelados);
           elseif ($meses_cancelados > 6 && $meses_cancelados < 12)
           $monto_pagar = $monto_total - ($monto_descuento*6);
           else 
           $monto_pagar = $monto_total - ($monto_descuento*$meses_cancelados);

           $pendientes = $pendientes - $meses_cancelados;

            if($pendientes > 0)
            $periodos_pendientes = DB::table('facturas')->select('periodo')
                 ->where('socio_id', $socio_id)->orderBy('periodo', 'desc')
                 ->limit($pendientes)->get();
            else $periodos_pendientes = array();


        $var = array('meses_cancelados' => $meses_cancelados,
            'monto' => $monto_pagar,
            'fecha_pago' => Carbon::now()->format('d-m-Y'),
            'forma_pago' => request('forma_pago'),
            'nombre_usuario' => $user->nombre_usuario,
            'pago_hasta' => $pago_hasta
            );

        return view('facturas.pago', compact('socio', 'var', 'periodos_pendientes'));
    }

    public function CalcularUltimoPago($ultima_factura, $meses_cancelados){

        if($ultima_factura){
            $pago_hasta = new Carbon($ultima_factura->periodo);

            if($ultima_factura->estado_id == 3){
                for ($i=1; $i < $meses_cancelados; $i++) { 
                $pago_hasta->addMonth();
            }
        } else {
            for ($i=0; $i < $meses_cancelados; $i++) { 
                $pago_hasta->addMonth();
        }
        }
            return $pago_hasta;
        }
        else{
            $pago_hasta = Carbon::createFromDate(null, null, 1);

             for ($i=1; $i < $meses_cancelados; $i++) { 
                $pago_hasta->addMonth();
                }

                return $pago_hasta;
        }
    }


    public function pagar($id)
    {
        $factura = new Factura;

        $factura = $factura->select()
             ->where('facturas.id', $id)
            ->first();

        return view('facturas.edit', compact('factura'));
    }

   public function edit($id)
    {
        $factura = new Factura;

        $factura = $factura->ObtenerPorId($id);

        $editar = true;

        return view('facturas.edit', compact('factura', 'editar'));
    }

    public function update($id)
    {
        $factura = new Factura;
        $cobro = new Cobro;

    	$facturaBD = Factura::find($id);
        $socio = Socio::find($facturaBD->socio_id);
        $user_id = Auth::user()->id;
        $forma_pago = request('forma_pago');
        $estado = request('estado');
        $estado_facturaBD = $facturaBD->estado_id;

        $categoria = $factura->ObtenerCategoriaDeSocio($socio->id);

        $factura->store($facturaBD, $socio->id, 1, $categoria->precio_categoria, $forma_pago, null, $facturaBD->periodo, Carbon::now(), $estado);

        if(request('tipo') == 'pago')
        $cobro->GenerarCobroUsuario($facturaBD->id, 3);

        elseif ($estado_facturaBD == 4 && $estado == 3)
                DB::table('cobros')->where('factura_id', $id)->delete();

		 return redirect('/facturas/index')->with('info', 'Operación exitosa');
    }

    public function show($id)
    {
        $factura = new Factura;

        $factura = $factura->ObtenerPorId($id);

        return view('facturas.detail', compact('factura'));
    }

    public function RequestFiltrar(){

        $criterio = request("Criterio");
        $valor = request("valor");
        $estado = request("estado");

     return redirect("/facturas/filtrar/".$criterio."/".$valor."/".$estado);   
    }

    public function filtrar($criterio, $valor, $estado_id){

        $factura = new Factura;
        $query = $factura->select();

        if ($criterio == 0)
            $query->where('facturas.id', $valor); 

       elseif ($criterio == 1)
            $query->where('facturas.socio_id', $valor);

       elseif ($criterio == 2)
            $query->where(DB::raw("CONCAT(personas.primer_nombre, ' ', personas.primer_apellido, ' ', personas.segundo_apellido)"), 'like', '%'.$valor.'%');

       elseif ($criterio == 3)
            $query->where('categorias.categoria', 'like', '%'.$valor.'%');

       elseif ($criterio == 4) {
            if(strlen($valor) == 7)
            $valor = substr($valor, 3, 4)."-".substr($valor, 0, 2);
            $query->where('facturas.periodo', 'like', '%'.$valor.'%');
    }

    $facturas = $this->filtrar_estado($query, $estado_id);

    return view('facturas.list', compact('facturas', 'valor', 'estado_id'));
    }

    public function RequestFiltrarSocio(){

        $criterio = request("Criterio");
        $valor = request("valor");
        $estado = request("estado");
        $socio_id = request("socio_id");

     return redirect("/socio/facturas/filtrar/".$socio_id."/".$criterio."/".$valor."/".$estado);   
    }

    public function filtrar_socio($socio_id, $criterio, $valor, $estado_id){

        $factura = new Factura;
        $query = $factura->ObtenerPorCriterio('facturas.socio_id', $socio_id);

        if ($criterio == 0)
            $query->where('facturas.id', $valor); 

       elseif ($criterio == 4) {
            if(strlen($valor) == 7)
            $valor = substr($valor, 3, 4)."-".substr($valor, 0, 2);
            $query->where('facturas.periodo', 'like', '%'.$valor.'%');
    }

    $facturas = $this->filtrar_estado($query, $estado_id);
    $socio = $factura->select_socio()->where('socios.id', $socio_id)->first();

    return view('socios.facturas', compact('facturas', 'socio', 'estado_id'));
    }

    public function filtrar_estado($query, $estado){

        if ($estado != 0) 
            return $query->whereIn('facturas.estado_id', [$estado])->paginate(5);
        else return $query->paginate(10);
    }

    public function lista(){

        $factura = new Factura;

        $facturas = $factura->select()
            ->paginate(10);

        return view('facturas.list', compact('facturas'));
    }

    public function ListarPorSocio($socio_id)
    {
        $factura = new Factura;

        $facturas = $factura->ObtenerPorCriterio('facturas.socio_id', $socio_id)
                    ->paginate(10);

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
        
        return view('facturas.list', compact('facturas', 'estado_id'));
    }

    public function ListarPorSocioEstado($socio_id, $estado_id){

     $factura = new Factura;

     $facturas = $factura->ObtenerPorSocioEstado($socio_id,$estado_id)
                 ->paginate(10);
        
     $socio = $factura->select_socio()
            ->where('socios.id', $socio_id)
            ->first();

            return view('socios.facturas', compact('facturas', 'socio', 'estado_id'));
    }

    public function ListarPendientesSocio($socio_id, $estado_id){

     $factura = new Factura;

     $facturas = $factura->ObtenerPorSocioEstado($socio_id, $estado_id)
                 ->paginate(10);
    
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

        $pendientes = $factura->ObtenerPorFechaCriterio($desde, $hasta, 'facturas.estado_id', 3);
        $pagas = $factura->ObtenerPorFechaCriterio($desde, $hasta, 'facturas.estado_id', 4);

        $facturas_pendientes = $pendientes->count();
        $facturas_pagas = $pagas->count();

        $monto_recaudado = $pagas->sum('monto');
        $monto_sin_liquidar = $pendientes->sum('monto');

        $porcentaje_pagas = number_format(($facturas_pagas / $facturas_fecha) * 100, 2, '.', '');
        $porcentaje_pendientes = number_format(($facturas_pendientes / $facturas_fecha) * 100, 2, '.', '');

            return view('facturas.recuento_mes', compact('desde', 'hasta', 'facturas_fecha', 'facturas_pendientes', 'facturas_pagas', 'porcentaje_pagas', 'porcentaje_pendientes', 'monto_recaudado', 'monto_sin_liquidar'));
        }else{
            return redirect('/facturas/recuento')->with('warning', 'No se encontraron facturas en la fecha solicitada');
        }
    }

    public function ConsultarMorosidad(){
        return view('facturas.buscar_moroso');
    }

    public function BuscarMoroso($criterio, $valor){

        if(!is_numeric($valor)) return with("<div class='alert alert-warning text-center text-warning'>".
            " <b> El campo de búsqueda solo acepta números </b> </div>");

        $factura = new Factura;

       $socio = $factura->ObtenerSocioPorCriterio($criterio, $valor);

       if($socio!=null){

        $socio = $factura->select_socio()->where('socios.id', $socio->socio_id)->first();

        $query = DB::table('facturas')
                            ->where('facturas.socio_id', $socio->socio_id)
                            ->where('facturas.estado_id', 3);
        
        $pendientes = $query->get();
        $monto = $query->sum('monto');

        return view('facturas.morosidad_socio', compact('socio', 'pendientes', 'monto'));
       }
       else
        return with("<div class='alert alert-warning text-center text-warning'>".
            " <b> El dato no coinside con ningún socio </b> </div>");
    }

     public function ListarSociosMorosos(){

        $factura = new Factura;

        $morosos = $factura->ObtenerSociosMorosos();

        return view ('facturas.morosos', compact('morosos', 'factura'));
    }

    public function ReporteSociosMorosos(){
        $factura = new Factura;
        $reporte = new PdfController;
        $fecha = date('d-m-Y');

        $morosos = $factura->ObtenerSociosMorosos();

        $pdf = PDF::loadView('reportes.socios_morosos', compact('morosos', 'factura', 'fecha'));

        return $pdf->download('Socios morosos '.$fecha.'.pdf');

        //return $pdf->stream('reporte.pdf'); ver el reporte en el navegador   
    }

    public function ListarPorFecha($desde, $hasta){

        $factura = new Factura;

        $facturas = $factura->ObtenerPorFecha($desde, $hasta)
                    ->paginate(10);
        
        return view('facturas.list_fecha', compact('facturas', 'desde', 'hasta'));
    }

    public function ListarPorFechaEstado($desde, $hasta, $estado_id){

        $factura =  new Factura;

        $facturas = $factura->ObtenerPorFechaCriterio($desde, $hasta, 'facturas.estado_id', $estado_id)
                    ->paginate(10);
        
        return view('facturas.list_fecha', compact('facturas', 'desde', 'hasta'));
    }

    public function facturas_pendientes(){

        $factura = new Factura;

        $facturas = $factura->ObtenerPorCriterio('facturas.estado_id', 3)
                    ->get();

        return view('facturas.pendientes', compact('facturas'));
    }

    public function factura_imprimir($id){

        $factura = new Factura;

        $factura = $factura->ObtenerPorId($id);

        return view('facturas.factura', compact('factura'));
    }

    public function imprimir(){

        $factura = new Factura;

        $facturas = Input::except('_token');
            
        $facturas_imprimir = $factura->select()->whereIn('facturas.id', $facturas)->get();

        if(count($facturas_imprimir)){
            $hora = Carbon::now();

           return view('facturas.imprimir', compact('facturas_imprimir', 'hora'));
        } else
        return back()->with('warning', 'No se han seleccionado facturas para imprimir');

/*        if(count($facturas_imprimir)){
           $pdf = PDF::loadView('facturas.factura', compact('facturas_imprimir'));

           $fecha = date('d-m-Y');
        
           return $pdf->download('Facturas a cobrar '.$fecha.'.pdf');
        } else
        return back()->with('warning', 'No se han seleccionado facturas para imprimir');*/
        
    }

    public function generarCobros(){

        $facturas = Input::except('_token');

        $cobro = new Cobro;

        foreach ($facturas as $factura) {
            $facturaBD = Factura::find($factura);

            $facturaBD->estado_id = 4;

            $facturaBD->save();

            $cobro->GenerarCobroUsuario($factura, 3);
        }

        return redirect('/facturas/index')->with('info', 'Operación exitosa!');
    }

    public function destroy($id)
    {
    	$factura = Factura::find($id);
	    $factura->delete();

		return redirect('/');
    }

}