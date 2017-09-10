<?php

namespace App\Http\Controllers;
use App\Http\Requests\CrearPersonaRequest;
use Illuminate\Http\Request;
use App\Persona;
use App\User;

class PersonasController extends Controller
{
    public function home()
    {
       $personas = Persona::paginate(9);
          return view('personas.list', [
              'personas' => $personas,
          ]);
    }

    public function show(Persona $persona)
    {

    	return view('personas.show',[
    		'persona' => $persona,
    		'usuario' =>$persona->usuario
    		]);
    }
    
}
