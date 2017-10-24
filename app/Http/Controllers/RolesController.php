<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRolesRequest;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::paginate(4);
        return view('roles.agregarRoles', [
              'roles' => $roles,
          ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CreateRolesRequest $request)
    {

        $role = Role::create(
            [
                    'rol'=> $request->input('rol'),
                    'descripcion'=> $request->input('descripcion'),
            ]);

        return redirect('/roles/index')->with('info','Role creado exitosamente!');
    }


    public function show(Role $role)
    {

        return view('roles.show',[
            'role' => $role,
            ]);
        
    }

    public function update(CreateRolesRequest $request, $id)
    {

        $role = Role::find($id);

        $role->rol = $request->input('rol');
        $role->descripcion = $request->input('descripcion');
        $role->save();
        
        return redirect('/roles/index')->with('warning','Datos actualizados exitosamente!');
    }

}
