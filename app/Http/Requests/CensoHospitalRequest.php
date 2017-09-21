<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CensoHospitalRequest extends Request
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
            'ocupacion'         => 'required',
            'telefono'          => 'required|regex:/^[0-9]{2,3}(\-)[0-9]{3,4}(\-)[0-9]{4}$/',
            'nom_familiar'      => 'required|min:10',
            'tel_familiar'      => 'required|regex:/^[0-9]{2,3}(\-)[0-9]{3,4}(\-)[0-9]{4}$/',
            'fecha_ingreso'     => 'required',
            'origen_ingreso'    => 'required|not_in:0',
            'tipo_svc'          => 'required|numeric|not_in:0',
            'especialidad'      => 'required|not_in:0',
            'cedula'            => 'required|not_in:0',
            'turno'             => 'required',
            'cama'              => 'required|regex:/^[A-Z]{1,4}(\-)[0-9]{1,3}$/',
            'dx_entrada'        => 'required|not_in:0'
        ];
    }

    public function messages()
    {
        return [
            'telefono.regex'            => 'El formato debe ser 961-123-4567 o 55-1234-5789',
            'nom_familiar.required'     => 'El nombre del familiar es obligatorio',
            'tel_familiar.required'     => 'El telefono del familiar es obligatorio',
            'tel_familiar.regex'        => 'El formato debe ser 961-123-4567 o 55-1234-5789',
            'tipo_svc.not_in'           => 'El servicio seleccionado es incorrecto',
            'origen_ingreso.required'   => 'El origen de ingreso es obligatorio',
            'especialidad.required'     => 'La especialidad es obligatoria',
            'cedula.required'           => 'El medico especialista es obligatorio',
            'dx_entrada.required'       => 'El diagnóstico es obligatorio',
            'dx_entrada.not_in'         => 'Debe seleccionar un diagnóstico'
        ];
    }
}
