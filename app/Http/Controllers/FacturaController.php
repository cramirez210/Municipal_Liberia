<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Factura;
use App\Socio;

class FacturaController extends Controller
{
   public function create()
    {
    	//$socio = Socio::find($socio_id);

    	//return view('registrar_factura', compact('socio'));

        return view('factura.create');
    }

    public function store($socio_id)
    {
    	$factura = new Factura;

    	$factura->save();

		return redirect('/');
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