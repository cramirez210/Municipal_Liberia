<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFacturaRequest;
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

        public function edit($id)
    {
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

    public function list()
    {
        $facturas = Factura::all();

        return view('factura.list', compact('facturas'));
    }

    public function destroy($id)
    {
    	$factura = Factura::find($id);
	    $factura->delete();

		return redirect('/');
    }
}