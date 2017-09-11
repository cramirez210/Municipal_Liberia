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

    public function show_update(Persona $persona)
    {
        return view('personas.update',[
        'persona' => $persona,
        'usuario' =>$persona->usuario
        ]);
    }

    public function update(CrearPersonaRequest $request, $id)
    {
        $persona = Persona::find($id);
        $usuario = Persona::find($id)->usuario;

        $persona->primer_nombre = $request->input('primer_nombre');
        $persona->segundo_nombre = $request->input('segundo_nombre');
        $persona->primer_apellido = $request->input('primer_apellido');
        $persona->segundo_apellido = $request->input('segundo_apellido');
        $persona->cedula = $request->input('cedula');
        $persona->fecha_nacimiento = $request->input('fecha_nacimiento');
        $persona->email = $request->input('email');
        $persona->telefono = $request->input('telefono');
        $persona->direccion = $request->input('direccion');
        $usuario->nombre_usuario = $request->input('nombre_usuario');
        //$usuario->rol = $request->input('rol');
        
        $persona->save();
        $usuario->save();

        return redirect('/personas/listar')->withSuccess('Los datos del usuario han sido actualizados exitosamente!');

    }
    
}
