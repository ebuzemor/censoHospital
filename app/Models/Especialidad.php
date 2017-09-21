<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Especialidad extends Model
{
    protected $table = 'especialidad';

    public function getDescripcionNivelAttribute()
    {
    	return $this->attributes['descripcion'].' Nivel: '.$this->attributes['nivel'];
    }

    public static function DescripcionNivel()
    {
    	$consulta = DB::select("SELECT CONCAT_WS(' ', descripcion, ', NIVEL:', nivel) AS descripcion_nivel, clave
    							FROM CATALOGOS.especialidad
    							ORDER BY descripcion");
    	return $consulta;
    }
}
