<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class CensoHospital31500 extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'censo_Hospital_31500';
    protected $fillable =[
    	'id',
    	//'clip',
    	//'rfc',
    	//'parent',
    	'clap',
    	'cama',
    	//'diagnostico',
        'dx_entrada',
        'dx_salida',
    	'turno',
        'especialidad',
        'cedula',
    	'cedula_alta',
    	'tipo_svc',
        'origen_ingreso',
        'fecha_ingreso',
    	'fecha_salida',
    	'duracion',
        'motivo',
    	//'sector',
        'ocupacion',
        'telefono',
        'nom_familiar',
        'tel_familiar',
    ];
    protected $hidden = [];

    public static function mostrarPacientes($fecini, $fecfin)
    {        
        $consulta = DB::select("SELECT h.id, h.clap, c.rfc, a.descripcion AS 'parentesco', 
                                CONCAT_WS(' ', p.nombre, p.apepat, p.apemat) AS 'paciente',
                                CONCAT_WS(' ', m.nombre, m.apepat, m.apemat) AS 'doctor', e.descripcion AS 'especialidad',  
                                s.descripcion AS 'sector', v.descripcion AS 'servicio', DATE(h.fecha_ingreso) AS fecha_ingreso
                                FROM SERVMED.citas31500 c
                                JOIN CATALOGOS.censo_hospital_31500 h ON c.clap = h.clap
                                JOIN SERVPREST.padron_maestro p ON c.clip = p.clip
                                JOIN CATALOGOS.parentesco a ON c.parent = a.clave
                                JOIN CATALOGOS.sector s ON c.sector = s.clave
                                JOIN CATALOGOS.medicos m ON h.cedula = m.cedula
                                JOIN CATALOGOS.especialidad e ON h.especialidad = e.clave
                                JOIN CATALOGOS.servicios v ON h.tipo_svc = v.id
                                WHERE DATE(h.fecha_ingreso) BETWEEN '$fecini' AND '$fecfin'
                                AND h.cedula_alta IS NULL
                                ORDER BY h.fecha_ingreso DESC");
        return $consulta;
    }

    public static function ultimosCensados()
    {
        $consulta = DB::select("SELECT h.id, h.clap, c.rfc, a.descripcion AS 'parentesco', 
                                CONCAT_WS(' ', p.nombre, p.apepat, p.apemat) AS 'paciente',
                                CONCAT_WS(' ', m.nombre, m.apepat, m.apemat) AS 'doctor' , e.descripcion AS 'especialidad',  
                                s.descripcion AS 'sector', v.descripcion AS 'servicio', DATE(h.fecha_ingreso) AS fecha_ingreso
                                FROM SERVMED.citas31500 c
                                JOIN CATALOGOS.censo_hospital_31500 h ON c.clap = h.clap
                                JOIN SERVPREST.padron_maestro p ON c.clip = p.clip
                                JOIN CATALOGOS.parentesco a ON c.parent = a.clave
                                JOIN CATALOGOS.sector s ON c.sector = s.clave
                                JOIN CATALOGOS.medicos m ON h.cedula = m.cedula
                                JOIN CATALOGOS.especialidad e ON h.especialidad = e.clave
                                JOIN CATALOGOS.servicios v ON h.tipo_svc = v.id
                                WHERE h.cedula_alta IS NULL
                                ORDER BY h.fecha_ingreso DESC LIMIT 0, 20");
        return $consulta;   
    }

    public static function ultimosPacientes()
    {
        $consulta = DB::select("SELECT c.clap, c.clip, c.rfc, a.descripcion as 'parentesco', 
                                CONCAT_WS(' ', p.nombre, p.apepat, p.apemat) AS 'paciente', 
                                h.motivo, h.duracion, CONCAT_WS(' ', m.nombre, m.apepat, m.apemat) AS 'doctor', 
                                h.fecha_salida, h.id, s.descripcion as 'sector'
                                FROM CATALOGOS.censo_hospital_31500 h
                                LEFT JOIN SERVMED.citas31500 c ON h.clap = c.clap
                                LEFT JOIN SERVPREST.padron_maestro p ON c.clip = p.clip
                                LEFT JOIN CATALOGOS.medicos m ON h.cedula_alta = m.cedula AND m.unimed = '31500'
                                JOIN CATALOGOS.parentesco a ON c.parent = a.clave
                                JOIN CATALOGOS.sector s ON c.sector = s.clave
                                WHERE h.duracion != ''
                                ORDER BY h.fecha_salida DESC LIMIT 0, 10");
        return $consulta;
    }

    public static function mostrarAltaPacientes($fecini, $fecfin)
    {        
        $consulta = DB::select("SELECT c.clap, c.clip, c.rfc, a.descripcion as 'parentesco', 
                                CONCAT_WS(' ', p.nombre, p.apepat, p.apemat) AS 'paciente', 
                                h.motivo, h.duracion, CONCAT_WS(' ', m.nombre, m.apepat, m.apemat) AS 'doctor', 
                                DATE(h.fecha_salida) AS 'fecha_salida', h.id, s.descripcion as 'sector'
                                FROM CATALOGOS.censo_hospital_31500 h
                                LEFT JOIN SERVMED.citas31500 c ON h.clap = c.clap
                                LEFT JOIN SERVPREST.padron_maestro p ON c.clip = p.clip
                                LEFT JOIN CATALOGOS.medicos m ON h.cedula_alta = m.cedula AND m.unimed = '31500'
                                JOIN CATALOGOS.parentesco a ON c.parent = a.clave
                                JOIN CATALOGOS.sector s ON c.sector = s.clave
                                WHERE DATE(h.fecha_salida) BETWEEN '$fecini' AND '$fecfin'
                                ORDER BY h.fecha_salida DESC");
        return $consulta;
    }

    public static function detallesPaciente($clap)
    {
        $consulta = DB::select("SELECT CONCAT_WS(' ', p.nombre, p.apepat, p.apemat) AS 'paciente', 
                                i.descripcion AS 'dx_entrada', x.descripcion AS 'dx_salida',
                                h.cama, h.turno, h.telefono, h.nom_familiar, h.tel_familiar, 
                                CONCAT_WS(' ', m.nombre, m.apepat, m.apemat) AS 'doctor', 
                                e.descripcion AS 'especialidad', s.descripcion AS 'servicio' 
                                FROM CATALOGOS.censo_hospital_31500 h
                                JOIN SERVMED.citas31500 c ON h.clap = c.clap
                                LEFT JOIN SERVPREST.padron_maestro p ON c.clip = p.clip
                                JOIN CATALOGOS.medicos m ON h.cedula = m.cedula
                                JOIN CATALOGOS.especialidad e ON h.especialidad = e.clave
                                JOIN CATALOGOS.servicios s ON h.tipo_svc = s.id
                                LEFT JOIN CATALOGOS.cie10 i ON h.dx_entrada = i.codigo
                                LEFT JOIN CATALOGOS.cie10 x ON h.dx_salida = x.codigo
                                WHERE c.clap = ?", [$clap]);
        return $consulta;
    }
}