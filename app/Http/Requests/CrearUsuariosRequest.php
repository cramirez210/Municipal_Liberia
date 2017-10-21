<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CrearUsuariosRequest extends FormRequest
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

            'nombre_usuario' => 'required|string|max:50|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'primer_nombre' => ['required','max:25'],
            'segundo_nombre' => ['max:25'],
            'primer_apellido' => ['required','max:25'],
            'segundo_apellido' => ['required','max:25'],
            'fecha_nacimiento' => ['required','date_format:Y-m-d'],
            'cedula' => ['required','max:30'],
            'email' => ['required','max:150'],
            'telefono' => ['required','numeric','min:8'],
            'direccion' => ['required','max:260']
            //
        ];
    }

     public function messages()
     {
        return [
        'nombre_usuario.required'=>'Por favor, escriba el nombre de usuario','nombre_usuario.unique'=>'El nombre de usuario ya existe, por favor elija uno diferente','nombre_usuario.max'=>'El nombre de usuario no puede ser mayor a 50 caractéres','password.required'=>'Por favor digíte una contraseña','password.min'=>'La contraseña debe de ser mayor a 6 caracteres','password.confirmed'=>'Las contraseñas no coinciden',
            
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
            'direccion.max'=>'La dirección no puede ser mayor a 260 caracteres.'];

     }
}
