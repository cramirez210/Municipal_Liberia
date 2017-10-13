<?php

namespace App\Http\Controllers;

use App\Http\Requests\CrearUsuariosRequest;
use App\Persona;
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


        public function showCreate()
    {
             $roles=Role::all();
              return view('auth.register', [
              'roles' => $roles,
          ]);
    }


    public function index()
    {
        return view('usuarios.listar',[
            'usuarios' => null
        ]);
    }

    public function obtenerUsuariosEjecutivos()
    {
       return $usuarios = DB::table('users')
        ->join('personas', 'users.persona_id', '=', 'personas.id')
        ->join('roles','users.rol_id', '=', 'roles.id')
        ->select('users.*', 'personas.cedula','personas.primer_nombre','personas.segundo_nombre', 'personas.primer_apellido', 'personas.segundo_apellido','users.nombre_usuario')
        ->where('users.rol_id',3)
        ->get();
    }
    public function listarTodosLosUsuarios()
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
    public function create(CrearUsuariosRequest $request)
    {

          $persona = new Persona;
            $persona = $this->encontrarPorCedula($request);

            if($persona)
            {
                $rol = $this->encontrarRolPorNombre($request);
                $fill = ['nombre_usuario' => $request['nombre_usuario'],
                            'password' => bcrypt($request['password']),
                            'email' =>  $request['email'],
                            'persona_id'=>$persona->id,
                            'rol_id'=>$rol->id,
                            'estado_id'=>1
                        ];
            User::create($fill);
            }
            else
            {
                $persona = new Persona;
                $persona->primer_nombre = $request['primer_nombre'];
                $persona->segundo_nombre = $request['segundo_nombre'];
                $persona->primer_apellido= $request['primer_apellido'];
                $persona->segundo_apellido = $request['segundo_apellido'];
                $persona->cedula = $request['cedula'];
                $persona->fecha_nacimiento = $request['fecha_nacimiento'];
                $persona->email = $request['email'];
                $persona->telefono = $request['telefono'];
                $persona->direccion = $request['direccion'];

                $persona->save();

                $persona = $this->encontrarPorCedula($request);
                $rol = $this->encontrarRolPorNombre($request);

              
                $fill = ['nombre_usuario' => $request['nombre_usuario'],
                        'password' => bcrypt($request['password']),
                        'email' =>  $request['email'],
                        'persona_id'=>$persona->id,
                        'rol_id'=>$rol->id,
                        'estado_id'=>1
                    ];

                User::create($fill);
            }

       return redirect(url('usuarios/showCreate'))->withSuccess('Usuario creado exitosamente!');
    }


     private function encontrarPorCedula(CrearUsuariosRequest $request)
    {
         return Persona::where('cedula',$request['cedula'])->first();
    }

    private function encontrarRolPorNombre(CrearUsuariosRequest $request)
    {
         return Role::where('rol',$request['rol'])->first();
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

     public function obtenerUsuarioPorCriterio($criterio, $valor)
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
    public function listarPorEstado($id)
    {
        $usuarios = $this->usuariosPorEstado($id);

        $usuariosPaginados = $this->paginate($usuarios->toArray(),10);

            return view('usuarios.listar', [
                'usuarios' => $usuariosPaginados,
            ]);
    }

     public function usuariosPorEstado($id)
   {
       $usuarios = DB::table('users')
            ->join('personas', 'users.persona_id', '=', 'personas.id')
            ->select('users.*', 'personas.cedula','personas.primer_nombre','personas.segundo_nombre', 'personas.primer_apellido', 'personas.segundo_apellido', 'users.nombre_usuario')

            ->where('users.estado_id','=',$id)
            ->get();

            return $usuarios;
   }

   public function cambiarEstado(User $user)
   {
        $estado = $user->estado;
        
        if ($estado->id == 1) 
        {
                
            $user->estado_id = 2;
            $user->save();
        

          return redirect('/personas/mostrar/'.$user->id)->withSuccess('Usuario Inactivado Exitosamente!');
        } 
        else 
        {

            $user->estado_id = 1;
            $user->save();
        
          return redirect('/personas/mostrar/'.$user->id)->withSuccess('Usuario Activado Exitosamente!');
        }
   }

}
