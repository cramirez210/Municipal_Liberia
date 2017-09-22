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
            ->join('users', 'socios.usuario_id', '=', 'users.id')
            ->join('estados', 'socios.estado_id', '=', 'estados.id')
            ->select('socios.*', 'personas.cedula','personas.primer_nombre', 'personas.primer_apellido', 'personas.segundo_apellido', 'categorias.categoria', 'users.nombre_usuario', 'estados.estado')
            ->get()->paginate();

            return view('/socios/index', [
                'socios' => $socios,
            ]);
         
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
        $estado = $this->FindIdEstado($request->input('estado_id'));
        $idUser = Auth::user()->id;

        $persona = Persona::where('cedula',$request->input('cedula'))->first();
        
        if ($persona) {
            
            $socio = Socio::create([

                    'persona_id'=> $persona->id,
                    'estado_civil'=> $request->input('estado_civil'),
                    'categoria_id'=> $categoria->id,
                    'empresa'=> $request->input('empresa'),
                    'user_id'=> $idUser,
                    'estado_id'=> 1, //1 es para Activo por defecto. 

            ]);

        } else {

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

            ]);

        }
        
        

        return redirect('/socios/home')->withSuccess('Socio creada exitosamente!'); 
    }

    private function FindIdCategoriaSocio($data)
    {
        return Categoria::where('categoria',$data)->first();
    }

    private function FindIdEstado($data)
    {
       return Estado::where('estado',$data)->first();
    }

    private function FindCedulapersona($data)
    {
        $persona = Persona::where('cedula',$data)->first();
       return $persona->id;
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
    public function show($id)
    {
        //
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
