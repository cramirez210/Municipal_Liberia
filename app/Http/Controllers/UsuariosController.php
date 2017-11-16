<?php

namespace App\Http\Controllers;

use App\Http\Requests\CrearUsuariosRequest;
use App\Persona;
use App\Role;
use App\Socio;
use App\User;
use App\Cobro;
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
        // throw new Exception("Error Processing Request");
        

        return view('usuarios.listar',[
            'usuarios' => null
        ]);
    }

    public function obtenerUsuariosEjecutivos()
    {
       return $usuarios = DB::table('users')
        ->join('personas', 'users.persona_id', '=', 'personas.id')
        ->join('roles','users.rol_id', '=', 'roles.id')
        ->select('users.id', 'personas.cedula','personas.primer_nombre','personas.segundo_nombre', 'personas.primer_apellido', 'personas.segundo_apellido','users.nombre_usuario')
        ->where('users.rol_id',3)
        ->paginate(10);
    }
    public function listarTodosLosUsuarios()
    {
        $usuarios = DB::table('users')
        ->join('personas', 'users.persona_id', '=', 'personas.id')
        ->join('roles','users.rol_id', '=', 'roles.id')
        ->select('users.id as user_id', 'personas.*','users.nombre_usuario','roles.rol')
        ->paginate(10);

        return view('usuarios.listar', [
        'usuarios' => $usuarios,
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

       return redirect(url('usuarios/showCreate'))->with('info','Usuario creado exitosamente!');
    }


     private function encontrarPorCedula(CrearUsuariosRequest $request)
    {
         return Persona::where('cedula',$request['cedula'])->first();
    }

    private function encontrarRolPorNombre(CrearUsuariosRequest $request)
    {
         return Role::where('rol',$request['rol'])->first();
    }

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

    public function buscarUsuario(Request $request)
    {
       $this->validate($request,
            [
            'criterio' => 'required',
            'valor' => 'required',
            ]);
      
        $usuario = $this->obtenerUsuarioPorCriterio($request->input('criterio'),$request->input('valor'));

            return view('usuarios.listar', [
                'usuarios' => $usuario,
            ]);
    }

     public function obtenerUsuarioPorCriterio($criterio, $valor)
    {
        if ($criterio == 1) {

            $usuarios = DB::table('users')
            ->join('personas', 'users.persona_id', '=', 'personas.id')
            ->join('roles','users.rol_id', '=', 'roles.id')
            ->select('personas.*', 'personas.id as persona_id', 'users.*', 'users.nombre_usuario','roles.rol')

            ->where('personas.cedula','=',$valor)
            ->paginate(10);

        } else {
             $usuarios = DB::table('users')
            ->join('personas', 'users.persona_id', '=', 'personas.id')
            ->join('roles','users.rol_id', '=', 'roles.id')
            ->select('personas.*', 'personas.id as persona_id', 'users.*','users.nombre_usuario','roles.rol')

            ->where('users.nombre_usuario','=',$valor)
            ->paginate(10);
        }
            return $usuarios;
    }

    // public function paginate($items, $perPages)
    // {
    //    $pageStart = \Request::get('page',1);
    //    $offSet    = ($pageStart * $perPages)-$perPages;
    //    $itemsForCurrentPage = array_slice( $items, $offSet, $perPages, TRUE);

    //    return new \Illuminate\Pagination\LengthAwarePaginator(

    //     $itemsForCurrentPage, count($items), $perPages, \Illuminate\Pagination\Paginator::resolveCurrentPage(),
    //     ['path'=> \Illuminate\Pagination\Paginator::resolveCurrentPath()]
    //     );
    // }
    public function listarPorEstado($id)
    {
        $usuarios = $this->usuariosPorEstado($id);

            return view('usuarios.listar', [
                'usuarios' => $usuarios,
                'estado_id' => $id,

            ]);
    }
       public function usuariosPorEstado($id)
   {
       $usuarios = DB::table('users')
            ->join('personas', 'users.persona_id', '=', 'personas.id')
            ->join('roles','users.rol_id', '=', 'roles.id')
            ->select('users.id as user_id', 'personas.*', 'users.nombre_usuario','roles.rol')
            ->where('users.estado_id','=',$id)
            ->paginate(10);

            return $usuarios;
   }

     public function listarPorRole($id)
    {
        $usuarios = $this->usuariosPorRole($id);
            return view('usuarios.listar', [
                'usuarios' => $usuarios,
                'rol_id' => $id,
            ]);
    }

     public function usuariosPorRole($id)
   {
       $usuarios = DB::table('users')
            ->join('personas', 'users.persona_id', '=', 'personas.id')
            ->join('roles','users.rol_id', '=', 'roles.id')
            ->select('users.id as user_id', 'personas.*', 'users.nombre_usuario','roles.rol')

            ->where('users.rol_id','=',$id)
            ->paginate(10);

            return $usuarios;
   }
   public function cambiarEstado(User $user)
   {
        $estado = $user->estado;
        
        if ($estado->id == 1) 
        { 
            $user->estado_id = 2;
            $user->save();

          return redirect('/usuarios/home/')->with('warning','Usuario '.$user->nombre_usuario.' inactivado exitosamente!');
        } 
        else 
        {
            $user->estado_id = 1;
            $user->save();
        
          return redirect('/usuarios/home/')->with('info','Usuario '.$user->nombre_usuario.' activado exitosamente!');
        }
   }

  public function RequestFiltrar(){

        $criterio = request("Criterio");
        $valor = request("valor");
        $estado = request("estado");
        $rol = request("rol");

     return redirect("/usuarios/filtrar/".$criterio."/".$valor."/".$estado."/".$rol);   
    }

   public function filtrar($criterio, $valor, $estado_id, $rol_id){

        $user = new User;
        $query = DB::table('users')
        ->join('personas', 'users.persona_id', '=', 'personas.id')
        ->join('roles','users.rol_id', '=', 'roles.id')
        ->select('users.id as user_id', 'personas.*','users.nombre_usuario', 'roles.rol');

    if ($criterio == 0) 
        $query->where('personas.cedula', 'like', '%'.$valor.'%');
    elseif ($criterio == 1)
        $query->where('users.nombre_usuario', 'like', '%'.$valor.'%');
    elseif ($criterio == 2) 
        $query->where(DB::raw("CONCAT(personas.primer_nombre, ' ', personas.primer_apellido, ' ', personas.segundo_apellido)"), 'like', '%'.$valor.'%');

    $usuarios = $this->filtrar_rol_estado($query, $estado_id, $rol_id);

    return view('usuarios.listar', compact('usuarios', 'estado_id'));
    }

 public function filtrar_rol_estado($query, $estado, $rol){

    if($rol != 0)
        $usuarios = $query->whereIn('users.rol_id', [$rol])->paginate(5);
    elseif ($estado != 0) 
        $usuarios = $query->whereIn('users.estado_id', [$estado])->paginate(5);
    else $usuarios = $query->paginate(5);

        return $usuarios;
    }

   public function ReporteDeCobros($id){

        $cobro = new Cobro;

        $reporte = $cobro->ObtenerReporte($id);

        return view('usuarios.reporte_cobros', 
               compact('reporte'));
    }

}
