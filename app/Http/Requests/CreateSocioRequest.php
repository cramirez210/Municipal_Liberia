<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateSocioRequest extends FormRequest
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
            'fecha_nacimiento' => ['required','date'],
            'cedula' => ['required','max:10','min:9'],
            'email' => ['required','max:150'],
            'telefono' => ['required','max:50','min:8'],
            'direccion' => ['required','max:260'],
            'empresa' => ['required','max:25'],
            'estado_civil' => ['required'],
            'categoria_id' => ['required'],
            'imagen' => ['image'],

        ];
    }
}
