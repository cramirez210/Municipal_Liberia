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
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\CorreoController;

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
        $DB = new Socio;
        $socios = $DB->select()->paginate(10);
        $registros = count($socios);
            return view('/socios/index', compact('socios','registros'));
    }

    public function asignarEjecutivo()
    {
        $objeto = new UsuariosController;
        $usuarios = $objeto->obtenerUsuariosEjecutivos();

            return view('/socios/asignarEjecutivo',compact('usuarios'));
    }


    public function home(Request $request)
    {
        $this->validate($request,
            [
            'radio' => 'required',
            ],
            [
            'radio.required'=>'Seleccione un Ejecutivo!',
            ]);
        $objeto = new UsuariosController;
        $ejecutivo = User::find($request->input('radio'));
        $estados = Estado::all();
        $categorias = Categoria::all();

        return view('socios.create', compact('estados','categorias','ejecutivo'));
    }

    public function create(CreateSocioRequest $request)
    {
        $objeto = new UsuariosController;
        $categoria = $this->FindIdCategoriaSocio($request->input('categoria_id'));
        $ejecutivo = $objeto->obtenerUsuarioPorCriterio(2,$request->input('ejecutivo'));
        $idUser = $ejecutivo[0]->id;
        $persona = Persona::where('cedula',$request->input('cedula'))->first();
        
        $correo = new CorreoController;
        if ($persona) {
            $this->CrearSolamenteSocio($request,$categoria,$idUser, $persona);
            $correo->notificar($request,$categoria,$idUser, $persona);

        } else {
            $this->CrearPersonaAndSocio($request,$categoria,$idUser);
            $correo->notificar($request,$categoria,$idUser, $persona);
        }
        
    return redirect('/socios/asignarEjecutivo')->with('info','Socio creado exitosamente!');
            
    }

    public function CrearSolamenteSocio(CreateSocioRequest $request ,$categoria,$idUser, $persona)
    {
        $ruta ='';
        if ($request->file('imagen')) {
           $imagen = $request->file('imagen');
           $ruta = $imagen->store('socios','public');
        }else
        {
           $ruta = 'socios/default.jpg';
        }
           $socio = Socio::create([

                    'persona_id'=> $persona->id,
                    'estado_civil'=> $request->input('estado_civil'),
                    'categoria_id'=> $categoria->id,
                    'empresa'=> $request->input('empresa'),
                    'user_id'=> $idUser,
                    'estado_id'=> 1,
                    'saldo'=> ($categoria->precio_categoria*3)-$categoria->precio_categoria, 
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
        }else
        {
            $ruta = 'socios/default.jpg';
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

        return view('socios.show',compact('socio','persona','categoria','estado'));
    }

   public function listarPorEstado($id)
   {
    $DB = new Socio;
    $socios = $DB->select()->where('socios.estado_id',$id)->paginate(10);

        return view('/socios/index',compact('socios'));
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

         return redirect('/socios/index')->with('info','Los datos del usuario han sido actualizados exitosamente!');
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
        $DB = new Socio;
        if ($request->input('criterio') == 1) {
           $socios = $DB->select()->where('personas.cedula',$request->input('valor'))->paginate(10);
        } else {
           $socios = $DB->oselec()->where('socios.id',$request->input('valor'))->paginate(10);
        }
        
        return view('/socios/index',compact('socios'));
    }

    public function cambiarEstado($id)
    {
        $socio = Socio::find($id);
        $objeto = new Factura;
        $facturas = $objeto->ObtenerPorSocioEstado($id, 3);

        if ($socio->estado_id == 2) {     
            if (count($facturas)>=1) {

                return redirect('/socios/show/'.$id)->with('error',' ERROR -- Socio con facturas perdientes!');
            } else {   
                $socio->estado_id = 1;
                $socio->save();
            }
          return redirect('/socios/show/'.$id)->with('info','Socio Activado Exitosamente!');

        } else {
          if (count($facturas)>1) {
                return redirect('/socios/show/'.$id)->with('error','ERROR -- Socio con facturas perdientes!');
            } else {   
                $socio->estado_id = 2;
                $socio->save();
            }  
          return redirect('/socios/show/'.$id)->with('warning','Socio Inactivado Exitosamente!');
        }
        
    }

    public function showImagen(Socio $socio)
    {
        return view('socios.showImagen', [
                'socio' => $socio,
            ]);
    }

    public function paginate($items, $perPages)
    {
        //$sociosPaginados = $this->paginate($socios->toArray(),10);
       $pageStart = \Request::get('page',1);
       $offSet    = ($pageStart * $perPages)-$perPages;
       $itemsForCurrentPage = array_slice( $items, $offSet, $perPages, TRUE);

       return new \Illuminate\Pagination\LengthAwarePaginator(

        $itemsForCurrentPage, count($items), $perPages, \Illuminate\Pagination\Paginator::resolveCurrentPage(),
        ['path'=> \Illuminate\Pagination\Paginator::resolveCurrentPath()]
        );
    }

}
