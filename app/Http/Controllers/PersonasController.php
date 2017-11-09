<?php

namespace App\Http\Controllers;
use App\Http\Requests\CrearPersonaRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Persona;
use App\User;
use App\Role; 

class PersonasController extends Controller
{
    public function home()
    {


       $usuarios = User::paginate(9);  

          return view('personas.list', [
              'usuarios' => $usuarios,
          ]);
    }

    public function show($id)
    {

        $usuario = DB::table('users')
            ->join('personas', 'users.persona_id', 'personas.id')
            ->join('roles', 'users.rol_id', 'roles.id')
            ->select('personas.*', 'personas.id as persona_id', 'users.nombre_usuario', 'users.id', 'users.estado_id', 'roles.rol')
            ->where('users.id', $id)
            ->first();

            return view('personas.show', compact('usuario'));
    }

    public function show_update(User $user)
    {
        $roles = Role::all();
        $role = $user->role;

        return view('personas.update',[
        'usuario' => $user,
        'persona' => $user->persona,
        'roles' => $roles,
        'role' => $role,
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
        $user->email = $request->input('email');

        
        $role = $this->FindRoleByName($request->input('rol'));
        $user->rol_id = $role->id;

        $persona->save();
        $user->save();

        return redirect('/usuarios/home')->with('info','Los datos del usuario han sido actualizados exitosamente!');

    }

     private function FindRoleByName($data)
    {
        return Role::where('rol',$data)->firstOrFail();
    }
    
}
