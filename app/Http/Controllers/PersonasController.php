<?php

namespace App\Http\Controllers;
use App\Http\Requests\CrearPersonaRequest;
use Illuminate\Http\Request;
use App\Persona;

class PersonasController extends Controller
{
    //
    //
    //
    public function show_registrar()
    {
    	return view('personas.registro_personas');
    } 	

    public function create(CrearPersonaRequest $request)
    {


      dd('Entró persona');
   		$persona = Persona::create([

   				'primer_nombre'=> $request->input('primer_nombre'),
   				'segundo_nombre'=> $request->input('segundo_nombre'),
   				'primer_apellido'=> $request->input('primer_apellido'),
   				'segundo_apellido'=> $request->input('segundo_apellido'),
   				'cedula'=> $request->input('cedula'),
   				'fecha_nacimiento'=> $request->input('fecha_nacimiento'),
   				'email'=> $request->input('email'),
   				'telefono'=> $request->input('telefono'),
   				'direccion'=> $request->input('direccion')

   			]);

   			return redirect('/')->withSuccess('Persona creada exitosamente!'); 
    }
}
