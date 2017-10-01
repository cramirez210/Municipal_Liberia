<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Persona;
use App\Role;
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
            'nombre_usuario' => 'required|string|max:50|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'primer_nombre' => ['required','max:25'],
            'segundo_nombre' => ['max:25'],
            'primer_apellido' => ['required','max:25'],
            'segundo_apellido' => ['required','max:25'],
            'fecha_nacimiento' => ['required','date_format:Y-m-d'],
            'cedula' => ['required','max:30'],
            'email' => ['required','max:150','unique:personas'],
            'telefono' => ['required','numeric'],
            'direccion' => ['required','max:260']

            //'rol' => 'required|string|max:255',
        ],['nombre_usuario.required'=>'Por favor, escriba el nombre de usuario','nombre_usuario.unique'=>'El nombre de usuario ya existe, por favor elija uno diferente','nombre_usuario.max'=>'El nombre de usuario no puede ser mayor a 50 caractéres','password.required'=>'Por favor digíte una contraseña','password.min'=>'La contraseña debe de ser mayor a 6 caracteres','password.confirmed'=>'Las contraseñas no coinciden',
            
            'primer_nombre.required'=> 'Por favor, escribir el primer nombre.',
            'primer_nombre.max'=>'El primer nombre no puede ser mayor a 25 caracteres.',

            'segundo_nombre.max'=>'El segundo nombre no puede ser mayor a 25 caracteres.',

            'primer_apellido.required'=> 'Por favor, escribir el primer apellido.',
            'primer_apellido.max'=>'El primer apellido no puede ser mayor a 25 caracteres.',

            'segundo_apellido.required'=> 'Por favor, escribir el segundo apellido.',
            'segundo_apellido.max'=>'El segundo apellido no puede ser mayor a 25 caracteres.',

            'fecha_nacimiento.required'=> 'Por favor, seleccionar la fecha de nacimiento.',
            'fecha_nacimiento.date_format'=>'El campo de la fecha de nacimiento no cumple con el formato yyyy-mm-dd',

            'cedula.required'=> 'Por favor, escribir la cédula.',
            'cedula.max'=>'La cédula no puede ser mayor a 30 caracteres.',

            'email.required'=> 'Por favor, escribir el correo electrónico.',
            'email.max'=>'El correo electrónico no puede ser mayor a 150 caracteres.',

            'telefono.required'=> 'Por favor, escribir número de telefono.',
            'telefono.max'=>'El telefono no puede ser mayor a 50 caracteres.',

            'direccion.required'=> 'Por favor, escribir la dirección.',
            'direccion.max'=>'La dirección no puede ser mayor a 260 caracteres.',

            ]);
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
            $persona = $this->encontrarPorCedula($data);

            if($persona)
            {
                $rol = $this->encontrarRolPorNombre($data);
                $fill = ['nombre_usuario' => $data['nombre_usuario'],
                            'password' => bcrypt($data['password']),
                            'email' =>  $data['email'],
                            'persona_id'=>$persona->id,
                            'rol_id'=>$rol->id];
            User::create($fill);
            }
            else
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
                $rol = $this->encontrarRolPorNombre($data);

              
                $fill = ['nombre_usuario' => $data['nombre_usuario'],
                        'password' => bcrypt($data['password']),
                        'email' =>  $data['email'],
                        'persona_id'=>$persona->id,
                        'rol_id'=>$rol->id];

                User::create($fill);
            }

       return redirect(route('login'))->withSuccess('Persona creada exitosamente!');

    }


     private function encontrarPorCedula(array $data)
    {
         return Persona::where('cedula',$data['cedula'])->first();
    }

    private function encontrarRolPorNombre(array $data)
    {
         return Role::where('rol',$data['rol'])->first();
    }

    public function showRegistrationForm()
    {
        $roles=Role::all();
         return view('auth.register', [
              'roles' => $roles,
          ]);
    }

}
