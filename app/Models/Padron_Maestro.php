<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Padron_Maestro extends Model
{    
    protected $connection = 'servprest';
    protected $table = 'padron_maestro';    
    protected $primaryKey = 'clip';
    
    /*** ESTE CODIGO CARGA LA INFORMACIÓN DE UNA VISTA DE LA BD ***
    public function scopeFromView($query)
    {
    	return $query->from('pacientesmed');
    }
    //$pacientes = pacientesmed::fromView()->where('rfc', 'SAOL670531')->get();
    */

    public function getNombrePacienteAttribute()
    {
        return $this->attributes['apepat'].' '.$this->attributes['apemat'].' '.$this->attributes['nombre'];
    }

    public static function datosPaciente($clip)
    {
        $consulta = DB::select("SELECT CONCAT_WS(' ', p.apepat, p.apemat, p.nombre) AS NombrePaciente, p.rfc, p.edad, p.sexo, p.dir, 
                                       m.descripcion AS municipio, s.descripcion AS sector, p.clip, p.dir, p.tel
                                FROM SERVPREST.padron_maestro p
                                JOIN CATALOGOS.sector s ON p.sector = s.clave
                                JOIN CATALOGOS.municipios m ON p.muni = m.clave AND m.estado = 7
                                WHERE p.clip = ?", [$clip]);
        return $consulta;
    }
}