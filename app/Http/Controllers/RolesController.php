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

        return redirect('/roles/index')->withSuccess('Role creado exitosamente!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {

        return view('roles.show',[
            'role' => $role,
            ]);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateRolesRequest $request, $id)
    {

        $role = Role::find($id);

        $role->rol = $request->input('rol');
        $role->descripcion = $request->input('descripcion');
        $role->save();
        
        return redirect('/roles/index')->withSuccess('Datos actualizados exitosamente!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
