<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Persona;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Requests\CrearPersonaRequest;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    //protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator

     */
    protected function validator(array $data)
    {

        return Validator::make($data, [
            'id_persona' => '',
            'nombre_usuario' => 'required|string|max:50|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'primer_nombre' => ['required','max:25'],
            'segundo_nombre' => ['max:25'],
            'primer_apellido' => ['required','max:25'],
            'segundo_apellido' => ['required','max:25'],
            'fecha_nacimiento' => ['required'],
            'cedula' => ['required','max:30'],
            'email' => ['required','max:150'],
            'telefono' => ['required','max:50'],
            'direccion' => ['required','max:260']

            //'rol' => 'required|string|max:255',
        ],['nombre_usuario.required'=>'Por favor, escriba el nombre de usuario','nombre_usuario.unique'=>'El nombre de usuario ya existe, por favor elija uno diferente','nombre_usuario.max'=>'El nombre de usuario no puede ser mayor a 50 caractéres','password.required'=>'Por favor digíte una contraseña','password.min'=>'La contraseña debe de ser mayor a 6 caracteres','password.confirmed'=>'Las contraseñas no coinciden']);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

    

            $persona = new Persona;

            $persona->primer_nombre = $data['primer_nombre'];
            $persona->segundo_nombre = $data['segundo_nombre'];
            $persona->primer_apellido= $data['primer_apellido'];
            $persona->segundo_apellido = $data['segundo_apellido'];
            $persona->cedula = $data['cedula'];
            $persona->fecha_nacimiento = $data['fecha_nacimiento'];
            $persona->email = $data['email'];
            $persona->telefono = $data['telefono'];
            $persona->direccion = $data['direccion'];

            $persona->save();


     

        $persona = $this->encontrarPorCedula($data);


        

        $fill = ['nombre_usuario' => $data['nombre_usuario'],
            'password' => bcrypt($data['password']),
            'id_persona' =>$persona->id];

            User::create($fill);

       return redirect(route('login'))->withSuccess('Persona creada exitosamente!');

    }

     private function encontrarPorCedula(array $data)
    {
         return Persona::where('cedula',$data['cedula'])->first();
    }

}
