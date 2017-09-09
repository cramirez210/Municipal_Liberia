<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CrearRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'cedula_persona' => 'required|string|max:25|',
            'nombre_usuario' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            //'rol' => 'required|string|max:255',
        ];
    }

    public function register()
    {
        return[

        'nombre_usuario.required'=> 'Por favor, escribir el nombre de usuario.',
        'nombre_usuario.max'=> 'El nombre de usuario no puede ser mayor a 255 caracteres',

        'password.required'=> 'Por favor, escribir la contraseña.',
        'password.min'=> 'La contraseña no puede ser menor a 6 caracteres',

        'cedula_persona.required'=> 'Por favor, escribir número de cédula del usuario.',

        ];
    }
}
