<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AltaPacRequest extends Request
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
            'dx_salida'    => 'required|not_in:0',
            'motivo'        => 'required|min:10',
            'fecha_salida'  => 'required',
            'cedula_alta'   => 'required|numeric|not_in:0'
        ];
    }

    public function messages()
    {
        return [
            'dx_salida.required'   => 'El diagnóstico definitivo es obligatorio', 
            'dx_salida.not_in'     => 'Debe seleccionar un diagnóstico',
            'cedula_alta.required'  => 'Es obligatorio seleccionar un médico', 
            'cedula_alta.not_in'    => 'Debe seleccionar un médico'
        ];
    }
}
