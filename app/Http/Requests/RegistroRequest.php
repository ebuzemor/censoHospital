<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RegistroRequest extends Request
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
            'usuario'   => 'required|unique:usuarios_trabajo_social,usuario|alpha_num|min:4',
            'email'     => 'required|email|unique:usuarios_trabajo_social,email',
            'password'  => 'required|confirmed|min:5',
            'nombre'    => 'required|alpha_num|min:3',
            'apellidos' => 'required|alpha_num|min:3'
        ];
    }
}
