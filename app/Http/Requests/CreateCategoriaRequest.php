<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategoriaRequest extends FormRequest
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
            'categoria' => ['required', 'max:15'],
            'precio_categoria' => ['required', 'numeric', 'min:1'],
        ];
    }

      public function messages()
    {
        return[

            'categoria.required'=> 'Nombre de categoria requerida.',
            'categoria.max'=>'El Nombre no puede ser mayor a 15 caracteres.',


            'precio_categoria.required'=> 'Precio de categoria requerida.',
            'precio_categoria.min'=>'El precio no puede ser menor a 1 caracteres.',

            'precio_categoria.numeric'=> 'El campo precio solo accepta numeros.',
            
         ];
    }
}
