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


       $usuarios = User::paginate(9);  

          return view('personas.list', [
              'usuarios' => $usuarios,
          ]);
    }

    public function show(User $user)
    {


    	return view('personas.show',[
    		'usuario' => $user,
            'persona' => $user->persona,
            'role' => $user->role,

    		]);
    }

    public function show_update(User $user)
    {

        return view('personas.update',[
        'usuario' => $user,
        'persona' => $user->persona,
        ]);
    }

    public function update(CrearPersonaRequest $request,User $user)
    {
    
        $persona = $user->persona;


        $persona->primer_nombre = $request->input('primer_nombre');
        $persona->segundo_nombre = $request->input('segundo_nombre');
        $persona->primer_apellido = $request->input('primer_apellido');
        $persona->segundo_apellido = $request->input('segundo_apellido');
        $persona->cedula = $request->input('cedula');
        $persona->fecha_nacimiento = $request->input('fecha_nacimiento');
        $persona->email = $request->input('email');
        $persona->telefono = $request->input('telefono');
        $persona->direccion = $request->input('direccion');
        $user->nombre_usuario = $request->input('nombre_usuario');
        //$user->rol = $request->input('rol');
        
        $persona->save();
        $user->save();

        return redirect('/usuarios/home')->withSuccess('Los datos del usuario han sido actualizados exitosamente!');

    }
    
}
