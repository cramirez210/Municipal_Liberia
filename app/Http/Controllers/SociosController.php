<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Estado;
use App\Http\Requests\CreateSocioRequest;
use App\Persona;
use App\Socio;
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

    public function home()
    {
        $estados = Estado::all();
        $categorias = Categoria::all();

        return view('socios.create',[
                'estados' => $estados,
                'categorias' => $categorias,
            ]);
    }

    public function create(CreateSocioRequest $request)
    {
        $categoria = $this->FindIdCategoriaSocio($request->input('categoria_id'));
        $idUser = Auth::user()->id;

        $persona = Persona::where('cedula',$request->input('cedula'))->first();
        
        if ($persona) {
            
            $this->CrearSolamenteSocio($request,$categoria,$idUser, $persona);

        } else {

            $this->CrearPersonaAndSocio($request,$categoria,$idUser);

        }
        
    
        return redirect('/socios/home')->withSuccess('Socio creada exitosamente!'); 
    }

    public function CrearSolamenteSocio(CreateSocioRequest $request ,$categoria,$idUser, $persona)
    {
        $socio = Socio::create([

                    'persona_id'=> $persona->id,
                    'estado_civil'=> $request->input('estado_civil'),
                    'categoria_id'=> $categoria->id,
                    'empresa'=> $request->input('empresa'),
                    'user_id'=> $idUser,
                    'estado_id'=> 1,
                    'saldo'=> ($categoria->precio_categoria*3)-$categoria->precio_categoria, //1 es para Activo por defecto. 

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

            $socio = Socio::create([

                    'persona_id'=> $idNuevaPersona,
                    'estado_civil'=> $request->input('estado_civil'),
                    'categoria_id'=> $categoria->id,
                    'empresa'=> $request->input('empresa'),
                    'user_id'=> $idUser,
                    'estado_id'=> 1, //1 es para Activo por defecto
                    'saldo'=> ($categoria->precio_categoria*3)-$categoria->precio_categoria,

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

        return view('socios.show',
        [
            'socio' => $socio,
            'persona' => $persona,
            'categoria' => $categoria,
        ]);
    }

   public function indexActivos()
   { 
       $socios = DB::table('socios')
            ->join('personas', 'socios.persona_id', '=', 'personas.id')
            ->join('categorias', 'socios.categoria_id', '=', 'categorias.id')
            ->join('users', 'socios.user_id', '=', 'users.id')
            ->join('estados', 'socios.estado_id', '=', 'estados.id')
            ->select('socios.*', 'personas.cedula','personas.primer_nombre', 'personas.primer_apellido', 'personas.segundo_apellido', 'categorias.categoria', 'users.nombre_usuario', 'estados.estado')
            ->where('socios.estado_id','=','1')
            ->get();


            $sociosPaginados = $this->paginate($socios->toArray(),10);

            return view('/socios/index', [
                'socios' => $sociosPaginados,
            ]);
   }

     public function indexInactivos()
   { 
       $socios = DB::table('socios')
            ->join('personas', 'socios.persona_id', '=', 'personas.id')
            ->join('categorias', 'socios.categoria_id', '=', 'categorias.id')
            ->join('users', 'socios.user_id', '=', 'users.id')
            ->join('estados', 'socios.estado_id', '=', 'estados.id')
            ->select('socios.*', 'personas.cedula','personas.primer_nombre', 'personas.primer_apellido', 'personas.segundo_apellido', 'categorias.categoria', 'users.nombre_usuario', 'estados.estado')
            ->where('socios.estado_id','=','2')
            ->get();


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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

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
        $socio->empresa = $request->input('empresa');
        $socio->estado_civil = $request->input('estado_civil');
        $socio->categoria_id = $categoria->id;

        $persona->save();
        $socio->save();

         return redirect('/socios/index')->withSuccess('Los datos del usuario han sido actualizados exitosamente!');



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
