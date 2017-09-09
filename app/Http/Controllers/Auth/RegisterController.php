<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Persona;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/home';

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
            'nombre_usuario' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            //'rol' => 'required|string|max:255',
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

        $persona = $this->encontrarPorCedula($data);


        $fill = ['nombre_usuario' => $data['nombre_usuario'],
            'password' => bcrypt($data['password']),
            'id_persona' => $persona->id, ];


        return User::create($fill);
    }

     private function encontrarPorCedula(array $data)
    {
         return Persona::where('cedula',$data['id_persona'])->first();
    }

}
