<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Citas31500 extends Model
{
    protected $connection = 'servmed';
    protected $table = 'citas31500';
    protected $primaryKey = 'clap';

    protected $fillable = ['estatus'];

    public function scopeHospitalizados($query)
    {
    	return $query->where('servicio', 'H');
    }
    //$citas = citas31500::Hospitalizados()->paginate(10);
    //$citas = citas31500::whereBetween('fechaprog', [$fecini, $fecfin])->Hospitalizados()->get();

    public static function obtenerHospitalizados($inicio, $final)
    {    	
    	$consulta = DB::select("SELECT c.clap, c.folio, c.clip, c.rfc, a.descripcion AS 'parent', CONCAT_WS(' ', p.nombre, p.apepat, p.apemat) AS 'paciente' ,
    							c.fechaprog, CONCAT_WS(' ', m.nombre, m.apepat, m.apemat) AS 'doctor', s.descripcion AS 'sector', c.grabado
								FROM SERVMED.citas31500 c
								LEFT JOIN SERVPREST.padron_maestro p ON c.clip = p.clip
								LEFT JOIN CATALOGOS.medicos m ON c.cedulaprog = m.cedula AND c.unimed = m.unimed
								JOIN CATALOGOS.sector s ON c.sector = s.clave
								JOIN CATALOGOS.parentesco a ON c.parent = a.clave
								WHERE c.servicio='H'
								AND DATE(c.fechaprog) BETWEEN '$inicio' AND '$final'
                                AND c.clap NOT IN (SELECT clap FROM CATALOGOS.censo_hospital_31500)
                                ORDER BY c.grabado DESC ");
    	return $consulta;
    }

    public static function diaHospitalizados($hoy)
    {       
        $consulta = DB::select("SELECT c.clap, c.folio, c.clip, c.rfc, a.descripcion AS 'parent', CONCAT_WS(' ', p.nombre, p.apepat, p.apemat) AS 'paciente' ,
                                c.fechaprog, CONCAT_WS(' ', m.nombre, m.apepat, m.apemat) AS 'doctor', s.descripcion AS 'sector', c.grabado
                                FROM SERVMED.citas31500 c
                                LEFT JOIN SERVPREST.padron_maestro p ON c.clip = p.clip
                                LEFT JOIN CATALOGOS.medicos m ON c.cedulaprog = m.cedula AND c.unimed = m.unimed
                                JOIN CATALOGOS.sector s ON c.sector = s.clave
                                JOIN CATALOGOS.parentesco a ON c.parent = a.clave
                                WHERE c.servicio='H'
                                AND DATE(c.fechaprog) = '$hoy'
                                AND c.clap NOT IN (SELECT clap FROM CATALOGOS.censo_hospital_31500)
                                ORDER BY c.grabado DESC ");
        return $consulta;
    }
}