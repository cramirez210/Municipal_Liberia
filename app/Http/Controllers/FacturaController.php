<?php


namespace App\Http\Controllers;

use App\Http\Requests\CreateFacturaRequest;
use App\Http\Controllers\SociosController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Factura;
use App\Socio;

class FacturaController extends Controller
{
   public function create($socio_id)
    {
    	$socio = Socio::find($socio_id);

        $persona = DB::table('personas')
             ->select('primer_nombre', 'primer_apellido', 'segundo_apellido')
             ->where('personas.id', $socio->persona_id)
            ->first();

        return view('facturas.create', compact('persona', 'socio'));
    }

    public function store($socio_id)
    {
        $user_id = Auth::user()->id;

        $socio = Socio::find($socio_id);

        $categoria = DB::table('categorias')
         ->select('precio_categoria')
         ->where('categorias.id', $socio->categoria_id)
         ->first();

        $factura = new Factura;

        $factura->socio_id = $socio_id;
        $factura->user_id = $user_id;
        $factura->meses_cancelados = request('meses_cancelados');
        $factura->monto = $categoria->precio_categoria;
        $factura->forma_pago = request('forma_pago');
        $factura->transaccion_bancaria = request('transaccion_bancaria');
        $factura->estado_id = 3;
        $factura->save();

        return redirect('/')->withSuccess('Factura creada correctamente');
    }

    public function GenerarFacturas(){

        $user_id = Auth::user()->id;
        $socios_controller = new SociosController;
        $socios_activos = $socios_controller->sociosPorEstado(1);

        foreach ($socios_activos as $socio) {

            $facturas_pendientes = $this->ObtenerPorSocioEstado($socio->id, 1);

            if(count($facturas_pendientes) === 3){
                $socioBD = Socio::find($socio->id);

                $socioBD->estado_id = 2;
                $socioBD->save();
            }
            else{
         $categoria = DB::table('categorias')
         ->select('precio_categoria')
         ->where('categorias.id', $socio->categoria_id)
         ->first();

        $factura = new Factura;

        $factura->socio_id = $socio->id;
        $factura->user_id = $user_id;
        $factura->meses_cancelados = 0;
        $factura->monto = $categoria->precio_categoria;
        $factura->forma_pago = "";
        $factura->transaccion_bancaria = "";
        $factura->estado_id = 1;
        $factura->save();
            }
        }
        return redirect('/')->withSuccess('Facturas creada correctamente');
            }

    public function edit($id){
    	$factura = Factura::find($id);

		return view('edit', compact('factura'));
    }

    public function update($id)
    {
    	$factura = Factura::find($id);

    	$factura->save();

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
            ->select('personas.primer_nombre', 'personas.primer_apellido', 'personas.segundo_apellido', 'facturas.id', 'facturas.socio_id', 'facturas.created_at', 'estados.estado')
            ->get();

        $facturas = $socios_controller->paginate($facturas->toArray(),5);
        
        return view('facturas.list', compact('facturas'));
    }

    public function ObtenerPorCriterio($texto_criterio, $valor_criterio)
    {
            $facturas = DB::table('socios')
            ->join('personas', 'socios.persona_id', '=', 'personas.id')
            ->join('facturas', 'facturas.socio_id', '=', 'socios.id')
            ->join('estados', 'facturas.estado_id', '=', 'estados.id')
            ->select('personas.primer_nombre', 'personas.primer_apellido', 'personas.segundo_apellido', 'facturas.id', 'facturas.socio_id', 'facturas.created_at', 'estados.estado')
            ->where($texto_criterio, $valor_criterio)
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
            ->select('personas.primer_nombre', 'personas.primer_apellido', 'personas.segundo_apellido', 'facturas.id', 'facturas.socio_id', 'facturas.monto', 'facturas.created_at', 'estados.estado')
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

    public function destroy($id)
    {
    	$factura = Factura::find($id);
	    $factura->delete();

		return redirect('/');
    }
}