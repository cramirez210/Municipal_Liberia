<?php


namespace App\Http\Controllers;

use App\Http\Requests\CreateFacturaRequest;
use App\Http\Controllers\SociosController;
use App\Http\Controllers\CobroController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Factura;
use App\Socio;
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
            ]);

       $criterio = $request->input('Criterio');
       $valor = $request->input('valor');

       $socio = $this->ObtenerSocioPorCriterio($criterio, $valor);

        if($socio != null){

            $facturas_pendientes = count($this->ObtenerPorSocioEstado($socio->socio_id, 3));

            if($facturas_pendientes > 0){
                $socio = $this->select_socio()
                        ->where('socios.id', $socio->socio_id)
                        ->first();

                $monto = DB::table('facturas')
                            ->where('socio_id', $socio->socio_id)
                            ->whereIn('estado_id', [3])
                            ->sum('monto');


        return view('facturas.create', compact('socio', 'facturas_pendientes', 'monto'));
    }else{
        return redirect('/facturas/pagar/buscar')->withSuccess('El socio no tiene facturas pendientes.');
    }

           
        }else{
        return redirect('/facturas/pagar/buscar')->withSuccess('El dato ingresado no corrresponde a ninguno de nuestros socios.');
        }
    }

    public function pagar($socio_id){

        $meses_cancelados = request('meses_cancelados');
        $forma_pago = request('forma_pago');

        $facturas = $this->select()
           ->where('facturas.socio_id', $socio_id)
           ->whereIn('facturas.estado_id', [3])
           ->limit($meses_cancelados)
           ->get();

        foreach ($facturas as $factura) {
            $facturaBD = Factura::find($factura->id);
            $cobro_controller = new CobroController;

            $this->store($facturaBD, $factura->socio_id, $factura->meses_cancelados, $factura->precio_categoria, $forma_pago, null, 4);

            $cobro_controller->GenerarCobroUsuario($factura->id, 3);
        }

        return redirect('/facturas/index')->withSuccess('Operación exitosa');
    }

   public function edit($factura_id)
    {
        $factura = $this->select()
             ->where('facturas.id', $factura_id)
            ->first();

        return view('facturas.edit', compact('factura'));
    }

    public function GenerarFacturas(){

        $socios_controller = new SociosController;
        $socios_activos = $socios_controller->sociosPorEstado(1);

        if(count($socios_activos) > 0){

            foreach ($socios_activos as $socio) {

            $facturas_pendientes = $this->ObtenerPorSocioEstado($socio->id, 3);

            if(count($facturas_pendientes) == 3){

                $this->InactivarSocio($socio->id);
            }
            else{
         
         $factura = new Factura;       
         $categoria = $this->ObtenerCategoriaDeSocio($socio);

         $this->store($factura, $socio->id, 1, $categoria->precio_categoria, '', null, 3);
            }
        }
        return redirect('/facturas/index')->withSuccess('Operación exitosa');
        } else{
        return redirect('/facturas/index')->withSuccess('No hay socios registrados en el sistema');
        }

        
            }

    public function store($factura, $socio_id, $meses_cancelados, $precio_categoria, $forma_pago, $transaccion_bancaria, $estado_id){

        $user_id = Auth::user()->id;

        $factura->socio_id = $socio_id;
        $factura->user_id = $user_id;
        $factura->meses_cancelados = $meses_cancelados;
        $factura->monto = $precio_categoria;
        $factura->forma_pago = $forma_pago;
        $factura->transaccion_bancaria = $transaccion_bancaria;
        $factura->estado_id = $estado_id;

        $factura->save();
    }

    public function InactivarSocio($id){

        $socio = Socio::find($id);

                $socio->estado_id = 2;
                $socio->save();
    }

    public function ObtenerCategoriaDeSocio($socio){
        return DB::table('categorias')
         ->select('precio_categoria')
         ->where('categorias.id', $socio->categoria_id)
         ->first();
    }

    public function update($id)
    {
        $cobro_controller = new CobroController;

    	$factura = Factura::find($id);
        $socio = Socio::find($factura->socio_id);
        $user_id = Auth::user()->id;
        $forma_pago = request('forma_pago');

        $categoria = $this->ObtenerCategoriaDeSocio($socio);

        $this->store($factura, $socio->id, 1, $categoria->precio_categoria, $forma_pago, null, 4);

        $cobro_controller->GenerarCobroUsuario($factura->id, 3);

		 return redirect('/facturas/index')->withSuccess('Operación exitosa');
    }

    public function show($id)
    {
        $factura = $this->ObtenerPorId($id);

        return view('facturas.detail', compact('factura'));
    }

    public function select(){

        return DB::table('socios')
            ->join('personas', 'socios.persona_id', 'personas.id')
            ->join('categorias', 'socios.categoria_id', 'categorias.id')
            ->join('facturas', 'facturas.socio_id', 'socios.id')
            ->join('users', 'facturas.user_id', 'users.id')
            ->join('estados', 'facturas.estado_id', 'estados.id')
            ->select('socios.id as socio_id', 'personas.primer_nombre', 'personas.primer_apellido', 'personas.segundo_apellido', 'facturas.*', 'categorias.categoria', 'categorias.precio_categoria', 'users.nombre_usuario', 'estados.estado')
            ->orderBy('facturas.id');
    }

    public function select_socio(){
        return DB::table('socios')
           ->join('personas', 'socios.persona_id', 'personas.id')
           ->join('categorias', 'socios.categoria_id', 'categorias.id')
         ->select('socios.id as socio_id', 'personas.primer_nombre', 'personas.primer_apellido', 'personas.segundo_apellido', 'categorias.categoria', 'categorias.precio_categoria')
         ->orderBy('socios.id');
    }

    public function list(){
        $socios_controller = new SociosController;

        $facturas = $this->select()
            ->get();

        $facturas = $socios_controller->paginate($facturas->toArray(),5);
        
        return view('facturas.list', compact('facturas'));
    }

    public function ObtenerPorCriterio($columna, $valor)
    {
            $facturas = $this->select()
            ->where($columna, $valor)
            ->get();

        return $facturas;
    }

    public function ObtenerPorId($id){

        $factura = $this->ObtenerPorCriterio('facturas.id', $id);

        return $factura[0];
    }

    public function ListarPorSocio($socio_id)
    {
        $socios_controller = new SociosController;

        $facturas = $this->ObtenerPorCriterio('facturas.socio_id', $socio_id);

        $facturas = $socios_controller->paginate($facturas->toArray(),5);

        $socio = $facturas[0];
        
        return view('socios.facturas', compact('facturas', 'socio'));
    }

        public function ListarPorEstado($estado_id)
    {
        $socios_controller = new SociosController;

        $facturas = $this->ObtenerPorCriterio('facturas.estado_id', $estado_id);

        $facturas = $socios_controller->paginate($facturas->toArray(),5);
        
        return view('facturas.list', compact('facturas'));
    }

        public function ObtenerPorSocioEstado($socio_id, $estado_id){

           $facturas = $this->select()
            ->where('facturas.socio_id', $socio_id)
            ->whereIn('facturas.estado_id', [$estado_id])
            ->get();

        return $facturas;
    }

    public function ListarPorSocioEstado($socio_id, $estado_id){

     $socios_controller = new SociosController;

     $facturas = $this->ObtenerPorSocioEstado($socio_id,$estado_id);

     $facturas = $socios_controller->paginate($facturas->toArray(),5);
        
        if(count($facturas) > 0){

            $socio = $facturas[0];

            return view('socios.facturas', compact('facturas', 'socio'));
        }
        else{
        $socio = $this->select_socio()
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
       $socios_controller = new SociosController;

       $this->validate($request,
            [
            'Criterio' => 'required',
            'valor' => 'required|numeric|max:999999999',
            ],
            [
            'valor.max'=>'Solo se admiten hasta 9 digitos.',
            ]);

       $criterio = $request->input('Criterio');
       $valor = $request->input('valor');

       $socio = $this->ObtenerSocioPorCriterio($criterio, $valor);

       if($socio!=null)
       return $this->ListarPorSocio($socio->socio_id);
       else
        return redirect('/facturas/buscar')->withSuccess('No se ha encontrado al socio');

    }

    public function ObtenerSocioPorCriterio($criterio, $valor){
        if($criterio == 2){
            $socio = $this->select_socio()
            ->where('personas.cedula', $valor)
            ->first();
        }else{
            $socio = DB::table('socios')
            ->select('socios.id as socio_id')
            ->where('socios.id', $valor)
            ->first();
        }

        return $socio;
    }

    public function BuscarRecuento(){
        return view('facturas.recuento');
    }

    public function recuento(){
        $mes = request('mes');
        $anio = request('anio');

        $facturas_fecha = count($this->ObtenerPorFecha($mes, $anio));
        $facturas_pendientes = count($this->ObtenerPorFechaCriterio($mes, $anio, 'facturas.estado_id', 3));
        $facturas_pagas = count($this->ObtenerPorFechaCriterio($mes, $anio, 'facturas.estado_id', 4));

        $porcentaje_pagas = number_format(($facturas_pagas / $facturas_fecha) * 100, 2, '.', '');
        $porcentaje_pendientes = number_format(($facturas_pendientes / $facturas_fecha) * 100, 2, '.', '');

        if($facturas_fecha > 0){

            return view('facturas.recuento_mes', compact('facturas_fecha', 'facturas_pendientes', 'facturas_pagas', 'mes', 'anio', 'porcentaje_pagas', 'porcentaje_pendientes'));
        }else{
            return redirect('/facturas/recuento')->withSuccess('No se encontraron facturas en el mes');
        }
        
    }

    public function ListarPorFecha($mes, $anio){

        $socios_controller = new SociosController;

        $facturas = $this->ObtenerPorFecha($mes, $anio);

        $facturas = $socios_controller->paginate($facturas->toArray(),5);
        
        return view('facturas.list', compact('facturas'));
    }

    public function ListarPorFechaEstado($mes, $anio, $estado_id){

        $socios_controller = new SociosController;

        $facturas = $this->ObtenerPorFechaCriterio($mes, $anio, 'facturas.estado_id', $estado_id);

        $facturas = $socios_controller->paginate($facturas->toArray(),5);
        
        return view('facturas.list', compact('facturas'));
    }

    public function ObtenerPorFecha($mes, $anio){
     
     $select = $this->select();
     
     $facturas = $select
            ->whereMonth('facturas.created_at', $mes)
            ->whereYear('facturas.created_at', $anio)
            ->get();

        return $facturas;   
    }

    public function ObtenerPorFechaCriterio($mes, $anio, $columna, $valor){
   
    $select = $this->select();
    
    $facturas = $select
            ->whereMonth('facturas.created_at', $mes)
            ->whereYear('facturas.created_at', $anio)
            ->where($columna, $valor)
            ->get();

        return $facturas;   
    }

    public function destroy($id)
    {
    	$factura = Factura::find($id);
	    $factura->delete();

		return redirect('/');
    }
}