<?php

namespace App\Http\Controllers;

use App\Estado;
use App\Http\Requests\CreateEstadoRequest;
use Illuminate\Http\Request;

class EstadoController extends Controller
{
    public function home()
    {
	 
	 $estados = Estado::paginate(4);

	        return view('/estados/create', [
	            'estados' => $estados,
	        ]);
	}

	public function create(CreateEstadoRequest $request)
	{

		$estado = Estado::create([
					'estado'=> $request->input('estado'),
			]);

		return redirect('/estados/home')->with('info','Estado creada exitosamente!');
	}

	public function show(Estado $estado)
	{
		return view('estados.show',[
    		'estado' => $estado,
    		]);
		
	}

	public function update(CreateEstadoRequest $request, $id)
	{

		$estado = Estado::find($id);

		$estado->estado = $request->input('estado');
		$estado->save();
		
		return redirect('/estados/home')->with('warning','Datos actualizados exitosamente!');
	}
}
