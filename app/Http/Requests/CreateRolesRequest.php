<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateRolesRequest extends FormRequest
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
            'rol' => ['required', 'max:20'],
            'descripcion' => ['required'],
        ];
    }
     public function messages()
    {
        return[

            'rol.required'=> 'Por favor, digite el rol.',
            'rol.max'=>'El rol requerido no puede ser mayor a 20 caracteres.',

            'descripcion.required'=> 'Por favor, digite el rol.',
        ];
    }
}
