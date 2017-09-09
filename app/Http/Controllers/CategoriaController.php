<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Http\Requests\CreateCategoriaRequest;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{

	public function home(){
	 
	 $categorias = Categoria::paginate(4);

	        return view('/categoria/create', [
	            'categorias' => $categorias,
	        ]);

	}

	public function create(CreateCategoriaRequest $request)
	{

		$categoria = Categoria::create([
					'categoria'=> $request->input('categoria'),
					'precio_categoria'=> $request->input('precio_categoria'),
			]);

		return redirect('/categoria/home')->withSuccess('Categoria creada exitosamente!');;
	}

	public function show(Categoria $categoria)
	{
		return view('categoria.show',[
    		'categoria' => $categoria,
    		]);
		
	}

	public function update(CreateCategoriaRequest $request, $id)
	{

		$categoria = Categoria::find($id);

		$categoria->categoria = $request->input('categoria');
		$categoria->precio_categoria = $request->input('precio_categoria');
		$categoria->save();
		
		return redirect('/categoria/home')->withSuccess('Datos actualizados exitosamente!');;
	}
   
}
