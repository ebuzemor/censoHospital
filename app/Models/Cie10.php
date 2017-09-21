<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Cie10 extends Model
{
    //por default la conexión es a la BD mysql->Catalogos	
    protected $table = 'cie10';

    public static function MostrarCie10($descripcion)
    {
    	$consulta = DB::select("SELECT codigo, descripcion
    							FROM CATALOGOS.cie10 c
    							WHERE c.codigo != '0000'
    							AND c.descripcion LIKE '%".$descripcion."%'");
    	return $consulta;
    }
}
