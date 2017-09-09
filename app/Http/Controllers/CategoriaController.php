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
		//dd($request->all());
		return 'llego';
	}


   
}
