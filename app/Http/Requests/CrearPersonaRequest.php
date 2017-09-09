<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CrearPersonaRequest extends FormRequest
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
            //
            'primer_nombre' => ['required','max:25'],
            'segundo_nombre' => ['max:25'],
            'primer_apellido' => ['required','max:25'],
            'segundo_apellido' => ['required','max:25'],
            'fecha_nacimiento' => ['required'],
            'cedula' => ['required','max:30'],
            'email' => ['required','max:150'],
            'telefono' => ['required','max:50'],
            'direccion' => ['required','max:260']
        ];
    }

     public function messages()
    {
        return[

            'primer_nombre.required'=> 'Por favor, escribir el primer nombre.',
            'primer_nombre.max'=>'El primer nombre no puede ser mayor a 25 caracteres.',

            'segundo_nombre.max'=>'El segundo nombre no puede ser mayor a 25 caracteres.',

            'primer_apellido.required'=> 'Por favor, escribir el primer apellido.',
            'primer_apellido.max'=>'El primer apellido no puede ser mayor a 25 caracteres.',

            'segundo_apellido.required'=> 'Por favor, escribir el segundo apellido.',
            'segundo_apellido.max'=>'El segundo apellido no puede ser mayor a 25 caracteres.',

            'fecha_nacimiento.required'=> 'Por favor, seleccionar la fecha de nacimiento.',

            'cedula.required'=> 'Por favor, escribir la cédula.',
            'cedula.max'=>'La cédula no puede ser mayor a 30 caracteres.',

            'email.required'=> 'Por favor, escribir el correo electrónico.',
            'email.max'=>'El correo electrónico no puede ser mayor a 150 caracteres.',

            'telefono.required'=> 'Por favor, escribir número de telefono.',
            'telefono.max'=>'El telefono no puede ser mayor a 50 caracteres.',

            'direccion.required'=> 'Por favor, escribir la dirección.',
            'direccion.max'=>'La dirección no puede ser mayor a 260 caracteres.',
        ];
    }
}
