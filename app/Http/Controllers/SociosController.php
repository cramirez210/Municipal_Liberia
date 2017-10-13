<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Estado;
use App\Factura;
use App\Http\Controllers\UsuariosController;
use App\Http\Requests\CreateSocioRequest;
use App\Persona;
use App\Socio;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SociosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('/socios/index',[
            'socios' => null,

        ]);
    }

    public function listarTodosLosSocios()
    {
        $socios = DB::table('socios')
            ->join('personas', 'socios.persona_id', '=', 'personas.id')
            ->join('categorias', 'socios.categoria_id', '=', 'categorias.id')
            ->join('users', 'socios.user_id', '=', 'users.id')
            ->join('estados', 'socios.estado_id', '=', 'estados.id')
            ->select('socios.*', 'personas.cedula','personas.primer_nombre', 'personas.primer_apellido', 'personas.segundo_apellido', 'categorias.categoria', 'users.nombre_usuario', 'estados.estado')
            ->get();

            $sociosPaginados = $this->paginate($socios->toArray(),10);

            return view('/socios/index', [
                'socios' => $sociosPaginados,
            ]);
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

    public function asignarEjecutivo()
    {
         $objeto = new UsuariosController;
        $usuarios = $objeto->obtenerUsuariosEjecutivos();

        $usuariosPaginados = $this->paginate($usuarios->toArray(),10);

            return view('/socios/asignarEjecutivo', [
                'usuarios' => $usuariosPaginados,
            ]);
    }


    public function home(Request $request)
    {
        $objeto = new UsuariosController;
        //$ejecutivo = $objeto->obtenerUsuarioPorCriterio(2,$request->input('radio'));
        $ejecutivo = User::find($request->input('radio'));
        $estados = Estado::all();
        $categorias = Categoria::all();

        return view('socios.create',
            [
                'estados' => $estados,
                'categorias' => $categorias,
                'ejecutivo' => $ejecutivo,
            ]);
    }

    public function create(CreateSocioRequest $request)
    {
        $objeto = new UsuariosController;
        $categoria = $this->FindIdCategoriaSocio($request->input('categoria_id'));
        $ejecutivo = $objeto->obtenerUsuarioPorCriterio(2,$request->input('ejecutivo'));
        $idUser = $ejecutivo[0]->id;
        
        $persona = Persona::where('cedula',$request->input('cedula'))->first();
        
        if ($persona) {
            
            $this->CrearSolamenteSocio($request,$categoria,$idUser, $persona);

        } else {

            $this->CrearPersonaAndSocio($request,$categoria,$idUser);

        }
        
    
        return redirect('/socios/asignarEjecutivo')->withSuccess('Socio creado exitosamente!'); 
    }

    public function CrearSolamenteSocio(CreateSocioRequest $request ,$categoria,$idUser, $persona)
    {
        $ruta ='';
        if ($request->file('imagen')) {
           $imagen = $request->file('imagen');
           $ruta = $imagen->store('socios','public');
        }
           $socio = Socio::create([

                    'persona_id'=> $persona->id,
                    'estado_civil'=> $request->input('estado_civil'),
                    'categoria_id'=> $categoria->id,
                    'empresa'=> $request->input('empresa'),
                    'user_id'=> $idUser,
                    'estado_id'=> 1,
                    'saldo'=> ($categoria->precio_categoria*3)-$categoria->precio_categoria, //1 es para Activo por defecto. 
                    'urlImagen' => $ruta,
            ]);   
    }

    public function CrearPersonaAndSocio(CreateSocioRequest $request,$categoria,$idUser)
    {
     $NuevaPersona = new Persona;


            $NuevaPersona->primer_nombre = $request->input('primer_nombre');
            $NuevaPersona->segundo_nombre = $request->input('segundo_nombre');
            $NuevaPersona->primer_apellido= $request->input('primer_apellido');
            $NuevaPersona->segundo_apellido = $request->input('segundo_apellido');
            $NuevaPersona->cedula = $request->input('cedula');
            $NuevaPersona->fecha_nacimiento = $request->input('fecha_nacimiento');
            $NuevaPersona->email = $request->input('email');
            $NuevaPersona->telefono = $request->input('telefono');
            $NuevaPersona->direccion = $request->input('direccion');
            $NuevaPersona->save();
            
            $idNuevaPersona = $this->FindCedulapersona($NuevaPersona->cedula);

            $ruta ='';
        if ($request->file('imagen')) {
           $imagen = $request->file('imagen');
           $ruta = $imagen->store('socios','public');
        }
            $socio = Socio::create([

                    'persona_id'=> $idNuevaPersona,
                    'estado_civil'=> $request->input('estado_civil'),
                    'categoria_id'=> $categoria->id,
                    'empresa'=> $request->input('empresa'),
                    'user_id'=> $idUser,
                    'estado_id'=> 1, //1 es para Activo por defecto
                    'saldo'=> ($categoria->precio_categoria*3)-$categoria->precio_categoria,
                    'urlImagen' => $ruta,

            ]);   
    }

    private function FindIdCategoriaSocio($data)
    {
        return Categoria::where('categoria',$data)->first();
    }

    private function FindCedulapersona($data)
    {
        $persona = Persona::where('cedula',$data)->first();
       return $persona->id;
    }
    
    public function show(Socio $socio)
    {
        $persona = $socio->persona;
        $categoria = $socio->categoria;
        $estado = $socio->estado;


        return view('socios.show',
        [
            'socio' => $socio,
            'persona' => $persona,
            'categoria' => $categoria,
            'estado' => $estado,
        ]);
    }

   public function sociosPorEstado($id)
   {
       $socios = DB::table('socios')
            ->join('personas', 'socios.persona_id', '=', 'personas.id')
            ->join('categorias', 'socios.categoria_id', '=', 'categorias.id')
            ->join('users', 'socios.user_id', '=', 'users.id')
            ->join('estados', 'socios.estado_id', '=', 'estados.id')
            ->select('socios.*', 'personas.cedula','personas.primer_nombre', 'personas.primer_apellido', 'personas.segundo_apellido', 'categorias.categoria', 'users.nombre_usuario', 'estados.estado')

            ->where('socios.estado_id','=',$id)
            ->get();

            return $socios;
           
   }

   public function listarPorEstado($id)
   {
       $socios = $this->sociosPorEstado($id);

        $sociosPaginados = $this->paginate($socios->toArray(),10);

            return view('/socios/index', [
                'socios' => $sociosPaginados,
            ]);
   }
    public function edit(Socio $socio)
    {
        $persona = $socio->persona;
        $categoria = $socio->categoria;
        $categorias = Categoria::all();

         return view('socios.update',
        [
            'socio' => $socio,
            'persona' => $persona,
            'categoria' => $categoria,
            'categorias' => $categorias,
        ]);


    }

    public function update(CreateSocioRequest $request, Socio $socio)
    {
        $persona = $socio->persona;
        
        // Actualizar objeto persona ----------------------------------------------------------
        $persona->primer_nombre = $request->input('primer_nombre');
        $persona->segundo_nombre = $request->input('segundo_nombre');
        $persona->primer_apellido = $request->input('primer_apellido');
        $persona->segundo_apellido = $request->input('segundo_apellido');
        $persona->fecha_nacimiento = $request->input('fecha_nacimiento');
        $persona->cedula = $request->input('cedula');
        $persona->email = $request->input('email');
        $persona->telefono = $request->input('telefono');
        $persona->direccion = $request->input('direccion');

        // Actualizar objeto socio --------------------------------------------------------------
       

        $categoria = $this->FindIdCategoriaSocio($request->input('categoria_id')); //Encontrar el objeto categoria.
        
        if($request->file('imagen') !== null)
        {
            $socio->urlImagen = $request->file('imagen')->store('socios', 'public');
        }
        $socio->empresa = $request->input('empresa');
        $socio->estado_civil = $request->input('estado_civil');
        $socio->categoria_id = $categoria->id;

        $persona->save();
        $socio->save();

         return redirect('/socios/index')->withSuccess('Los datos del usuario han sido actualizados exitosamente!');

    }

    public function buscarSocio(Request $request)
    {
       $this->validate($request,
            [
            'criterio' => 'required',
            'valor' => 'required|numeric|max:999999999',
            ],
            [
            'valor.max'=>'Solo se admiten hasta 9 digitos.',
            ]);
    
        $socio = $this->obtenerSocioPorCriterio($request->input('criterio'),$request->input('valor'));
        $socioPaginado = $this->paginate($socio->toArray(),10);

            return view('/socios/index', [
                'socios' => $socioPaginado,
            ]);
    }

    public function obtenerSocioPorCriterio($Criterio, $valor)
    {
        if ($Criterio == 1) {

            $socios = DB::table('socios')
            ->join('personas', 'socios.persona_id', '=', 'personas.id')
            ->join('categorias', 'socios.categoria_id', '=', 'categorias.id')
            ->join('users', 'socios.user_id', '=', 'users.id')
            ->join('estados', 'socios.estado_id', '=', 'estados.id')
            ->select('socios.*', 'personas.cedula','personas.primer_nombre', 'personas.primer_apellido', 'personas.segundo_apellido', 'categorias.categoria', 'users.nombre_usuario', 'estados.estado')

            ->where('personas.cedula','=',$valor)
            ->get();

        } else {
            $socios = DB::table('socios')
            ->join('personas', 'socios.persona_id', '=', 'personas.id')
            ->join('categorias', 'socios.categoria_id', '=', 'categorias.id')
            ->join('users', 'socios.user_id', '=', 'users.id')
            ->join('estados', 'socios.estado_id', '=', 'estados.id')
            ->select('socios.*', 'personas.cedula','personas.primer_nombre', 'personas.primer_apellido', 'personas.segundo_apellido', 'categorias.categoria', 'users.nombre_usuario', 'estados.estado')

            ->where('socios.id','=',$valor)
            ->get();
        }
            return $socios;
    }

    public function cambiarEstado($id)
    {
        $socio = Socio::find($id);
        $objeto = new Factura;
        $facturas = $objeto->ObtenerPorSocioEstado($id, 3);

        if ($socio->estado_id == 2) {
           
            
            
            if (count($facturas)>=1) {

                return redirect('/socios/show/'.$id)->withSuccess(' ERROR -- Socio con facturas perdientes!');
            } else {
                
                $socio->estado_id = 1;
                $socio->save();
            }
            

          return redirect('/socios/show/'.$id)->withSuccess('Socio Activado Exitosamente!');

        } else {

          if (count($facturas)>1) {


                return redirect('/socios/show/'.$id)->withSuccess('ERROR -- Socio con facturas perdientes!');
            } else {
                
                $socio->estado_id = 2;
                $socio->save();
            }  
            

          return redirect('/socios/show/'.$id)->withSuccess('Socio Inactivado Exitosamente!');
        }
        
    }

    public function showImagen(Socio $socio)
    {
        return view('socios.showImagen', [
                'socio' => $socio,
            ]);
    }

}
