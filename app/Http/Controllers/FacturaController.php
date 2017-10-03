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

class FacturaController extends Controller
{

    public function index(){
        return view('facturas.index');
    }

    public function create($socio_id){

        $socio = DB::table('socios')
             ->join('personas', 'socios.persona_id', 'personas.id')
             ->select('socios.id', 'personas.primer_nombre', 'personas.primer_apellido', 'personas.segundo_apellido')
             ->where('socios.id', $socio_id)
            ->first();

        $facturas_pendientes = count($this->ObtenerPorSocioEstado($socio_id, 3));

        return view('facturas.create', compact('socio', 'facturas_pendientes'));
    }

    public function pagar($socio_id){

        $meses_cancelados = request('meses_cancelados');
        $forma_pago = request('forma_pago');

        $facturas = DB::table('facturas')
           ->join('socios', 'facturas.socio_id', 'socios.id')
           ->join('categorias', 'socios.categoria_id', 'categorias.id')
           ->select('facturas.*', 'categorias.precio_categoria')
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

        return redirect('/')->withSuccess('Operación exitosa');
    }

   public function edit($factura_id)
    {
        $factura = DB::table('facturas')
             ->join('socios', 'facturas.socio_id', 'socios.id')
             ->join('personas', 'socios.persona_id', 'personas.id')
             ->select('socios.id as socio_id', 'personas.primer_nombre', 'personas.primer_apellido', 'personas.segundo_apellido', 'facturas.id', 'facturas.created_at')
             ->where('facturas.id', $factura_id)
            ->first();

        return view('facturas.edit', compact('factura'));
    }

    public function GenerarFacturas(){

        $socios_controller = new SociosController;
        $socios_activos = $socios_controller->sociosPorEstado(1);

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
        return redirect('/')->withSuccess('Facturas creada correctamente');
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

		return redirect('/');
    }

    public function show($id)
    {
        $factura = Factura::find($id);

        return view('detail', compact('factura'));
    }

    public function list(){
        $socios_controller = new SociosController;

        $facturas = DB::table('socios')
            ->join('personas', 'socios.persona_id', '=', 'personas.id')
            ->join('facturas', 'facturas.socio_id', '=', 'socios.id')
            ->join('estados', 'facturas.estado_id', '=', 'estados.id')
            ->select('personas.primer_nombre', 'personas.primer_apellido', 'personas.segundo_apellido', 'facturas.id', 'facturas.socio_id', 'facturas.created_at', 'facturas.estado_id', 'estados.estado')
            ->get();

        $facturas = $socios_controller->paginate($facturas->toArray(),5);
        
        return view('facturas.list', compact('facturas'));
    }

    public function ObtenerPorCriterio($columna, $valor)
    {
            $facturas = DB::table('socios')
            ->join('personas', 'socios.persona_id', '=', 'personas.id')
            ->join('facturas', 'facturas.socio_id', '=', 'socios.id')
            ->join('estados', 'facturas.estado_id', '=', 'estados.id')
            ->select('personas.primer_nombre', 'personas.primer_apellido', 'personas.segundo_apellido', 'facturas.id', 'facturas.socio_id', 'facturas.created_at', 'facturas.estado_id', 'estados.estado')
            ->where($columna, $valor)
            ->get();

        return $facturas;
    }

    public function ListarPorSocio($socio_id)
    {
        $socios_controller = new SociosController;

        $facturas = $this->ObtenerPorCriterio('facturas.socio_id', $socio_id);

        $facturas = $socios_controller->paginate($facturas->toArray(),5);
        
        return view('facturas.list', compact('facturas'));
    }

        public function ListarPorEstado($estado_id)
    {
        $socios_controller = new SociosController;

        $facturas = $this->ObtenerPorCriterio('facturas.estado_id', $estado_id);

        $facturas = $socios_controller->paginate($facturas->toArray(),5);
        
        return view('facturas.list', compact('facturas'));
    }

        public function ObtenerPorSocioEstado($socio_id, $estado_id){

           $facturas = DB::table('socios')
            ->join('personas', 'socios.persona_id', '=', 'personas.id')
            ->join('facturas', 'facturas.socio_id', '=', 'socios.id')
            ->join('estados', 'facturas.estado_id', '=', 'estados.id')
            ->select('personas.primer_nombre', 'personas.primer_apellido', 'personas.segundo_apellido', 'facturas.id', 'facturas.socio_id', 'facturas.monto', 'facturas.created_at', 'facturas.estado_id', 'estados.estado')
            ->where('facturas.socio_id', $socio_id)
            ->whereIn('facturas.estado_id', [$estado_id])
            ->get();

        return $facturas;
    }

    public function ListarPorSocioEstado($socio_id, $estado_id){

     $socios_controller = new SociosController;

     $facturas = $this->ObtenerPorSocioEstado($socio_id,$estado_id);

     $facturas = $socios_controller->paginate($facturas->toArray(),5);
        
     return view('facturas.list', compact('facturas'));

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
       $valor = $request->input('valor');

        return $this->ListarPorSocio($valor);
    }

    public function destroy($id)
    {
    	$factura = Factura::find($id);
	    $factura->delete();

		return redirect('/');
    }
}