<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Medicos extends Model
{
	//por default la conexión es a la BD mysql->Catalogos	
    protected $table = 'medicos';

    public function scopeMedicos31500($query)
    {
    	return $query->where('unimed', '31500')->orderBy('apepat')->orderBy('apemat');
    }

    public function getNombreMedicoAttribute()
    {
    	return $this->attributes['nombre'].' '.$this->attributes['apepat'].' '.$this->attributes['apemat'];
    }

    public static function listaMedicos31500()
    {
    	$consulta = DB::select("SELECT CONCAT_WS(' ', UPPER(m.nombre), UPPER(m.apepat), UPPER(m.apemat)) AS nombre_medico, m.cedula 
						   		FROM CATALOGOS.medicos m
						   		WHERE m.unimed=31500 AND m.cedula != ''
						   		ORDER BY m.apepat, m.apemat, m.nombre");
    	return $consulta;
    }

    public static function listaMedicosEspecialidad($clave)
    {
        $consulta = DB::select("SELECT CONCAT_WS(' ', UPPER(m.nombre), UPPER(m.apepat), UPPER(m.apemat)) AS nombre_medico, m.cedula
                                FROM CATALOGOS.medicos m
                                LEFT JOIN CATALOGOS.especialidad e ON m.especialidad = e.clave
                                WHERE m.activo ='S' AND m.unimed=31500 AND m.cedula != '987654'
                                AND e.clave='$clave' ORDER BY m.apepat, m.apemat");
        return $consulta;
    }
}
