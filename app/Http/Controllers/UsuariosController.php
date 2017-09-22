<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Socio;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuariosAdministrador = User::where("rol_id","=",1)->paginate(10);
        $usuariosEstandar = User::where("rol_id","=",2)->paginate(10);
       
        return view('usuarios.listar', [
              'usuariosAdministrador' =>  $usuariosAdministrador,
              'usuariosEstandar' => $usuariosEstandar, 
          ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function show(User $user)
    {

        $socios = $user->socios;
        $sociosActivos = Socio::where("estado_id","=",1)->paginate(10);
        $sociosInactivos = Socio::where("estado_id","=",2)->paginate(10);

        
        return view('usuarios.listarSociosDeUsuario', [

              'sociosActivos' => $sociosActivos,
              'sociosInactivos' => $sociosInactivos,
        
          ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
