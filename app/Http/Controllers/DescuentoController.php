<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\SociosController;
use Illuminate\Support\Facades\DB;
use App\Descuento;
use App\Categoria;

class DescuentoController extends Controller
{
    public function create(){

    	$descuentos = DB::table('descuentos')
    				->join('categorias', 'descuentos.categoria_id', 'categorias.id')
    				->select('descuentos.*', 'categorias.categoria')
    				->get();
    	$categorias = Categoria::all();

    	$socios_controller = new SociosController;

    	$descuentos = $socios_controller->paginate($descuentos->toArray(), 5);

    	return view('descuentos.create', compact('descuentos', 'categorias'));
    }

    public function store(){

    	$descuento = new Descuento;

    	$descuento->categoria_id = request('categoria');
    	$descuento->semestral = request('semestral');
    	$descuento->anual = request('anual');

    	$descuento->save();

    	return view('configuracion.index');
    }

    public function show($id){

        $descuento = Descuento::find($id);
        $categorias = Categoria::all();

        return view('descuentos.show', compact('descuento', 'categorias'));
    }

    public function update($id){

        $descuento = Descuento::find($id);

        $descuento->categoria_id = request('categoria');
        $descuento->semestral = request('semestral');
        $descuento->anual = request('anual');

        $descuento->save();

        return view('configuracion.index');

    }
}
