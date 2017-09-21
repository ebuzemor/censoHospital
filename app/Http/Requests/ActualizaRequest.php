<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ActualizaRequest extends Request
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
            'usuario'   => 'required|alpha_num|min:4',
            'email'     => 'required|email',
            'password'  => 'required|confirmed|min:5',
            'nombre'    => 'required|alpha_num|min:3',
            'apellidos' => 'required|alpha_num|min:3'
        ];
    }
}
