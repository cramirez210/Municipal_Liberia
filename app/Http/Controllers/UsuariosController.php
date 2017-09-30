<?php

namespace App\Http\Controllers;

use App\Role;
use App\Socio;
use App\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
        $usuarios = DB::table('users')
            ->join('personas', 'users.persona_id', '=', 'personas.id')
            ->join('roles','users.rol_id', '=', 'roles.id')
            ->select('users.*', 'personas.cedula','personas.primer_nombre','personas.segundo_nombre', 'personas.primer_apellido', 'personas.segundo_apellido','users.nombre_usuario')
            ->get();

            $usuariosPaginados = $this->paginate($usuarios->toArray(),10);

            return view('usuarios.listar', [
                'usuarios' => $usuariosPaginados,
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

    public function buscarUsuario(Request $request)
    {
       $this->validate($request,
            [
            'criterio' => 'required',
            'valor' => 'required',
            ]);
      
        $usuario = $this->obtenerUsuarioPorCriterio($request->input('criterio'),$request->input('valor'));

        $usuarioPaginado = $this->paginate($usuario->toArray(),10);

            return view('usuarios.listar', [
                'usuarios' => $usuarioPaginado,
            ]);
    }

     private function obtenerUsuarioPorCriterio($criterio, $valor)
    {
        if ($criterio == 1) {


            $usuarios = DB::table('users')
            ->join('personas', 'users.persona_id', '=', 'personas.id')
            ->join('roles','users.rol_id', '=', 'roles.id')
            ->select('users.*', 'personas.cedula','personas.primer_nombre','personas.segundo_nombre', 'personas.primer_apellido', 'personas.segundo_apellido','users.nombre_usuario')

            ->where('personas.cedula','=',$valor)
            ->get();

        } else {
             $usuarios = DB::table('users')
            ->join('personas', 'users.persona_id', '=', 'personas.id')
            ->join('roles','users.rol_id', '=', 'roles.id')
            ->select('users.*', 'personas.cedula','personas.primer_nombre','personas.segundo_nombre', 'personas.primer_apellido', 'personas.segundo_apellido','users.nombre_usuario')

            ->where('users.nombre_usuario','=',$valor)
            ->get();
        }
            return $usuarios;
    }

    public function paginate($items, $perPages)
    {
       $pageStart = \Request::get('page',1);
       $offSet    = ($pageStart * $perPages)-$perPages;
       $itemsForCurrentPage = array_slice( $items, $offSet, $perPages, TRUE);

       return new \Illuminate\Pagination\LengthAwarePaginator(

        $itemsForCurrentPage, count($items), $perPages, \Illuminate\Pagination\Paginator::resolveCurrentPage(),
        ['path'=> \Illuminate\Pagination\Paginator::resolveCurrentPath()]
        );
    }

}
