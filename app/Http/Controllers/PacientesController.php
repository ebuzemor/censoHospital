<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests;
use App\Models\Cie10;
use App\Models\Medicos;
use App\Models\Servicios;
use App\Models\Citas31500;
use App\Models\Especialidad;
use App\Models\Padron_Maestro;
use App\Models\CensoHospital31500;
use App\MyClasses\RutasIconos;
use App\Http\Requests\CensoHospitalRequest;
use Auth;
use Session;
use Request;
use Response;
use DateTime;

class PacientesController extends Controller
{
    function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
    	$ltarutas = new RutasIconos;
        $ltarutas->rutas = MenuController::rutas(Auth::User()->permisos);
        $ltarutas->iconos = MenuController::iconos(Auth::User()->permisos);
        $titulo = 'Buscar Pacientes Hospitalizados';
    	return view('pacientes.index', compact('ltarutas', 'titulo'));
    }

    public function consulta()
    {        
        $post = Request::all();
        $fecini = $post['fecini'];
        $fecfin = $post['fecfin'];
        $datos = Citas31500::obtenerHospitalizados($fecini, $fecfin);
        $titulo = 'Lista de Pacientes';
        return view('pacientes.citas', compact('datos', 'titulo', 'fecini', 'fecfin'));
    }

    public function consulta_hoy()
    {
        $fechoy = new DateTime();
        $fechoy = $fechoy->format('Y-m-d');
        $datos = Citas31500::diaHospitalizados($fechoy);
        $titulo = 'Lista de Pacientes';
        return view('pacientes.citas', compact('datos', 'titulo'));
    }

    public function agregarCenso(CensoHospitalRequest $request)
    {        
        try{
            $post = $request->all();
            //$censo = CensoHospital31500::where('clap', $post['clap'])->first();            
            $censo = new CensoHospital31500;
            $censo->fill($post)->saveOrFail();
        }catch(\Exception $e) {
            Session::flash('message-error', 'Error al registrar al paciente con CLAP: '.$post['clap'].'; descripción del error: '.$e->getMessage());
            return view('alertas.msjError');
        }
        Session::flash('message', 'El paciente fue agregado correctamente');
        return view('alertas.msjExito');
    }

    public function checarClap()
    {
        $post = Request::all();
        $censo = CensoHospital31500::where('clap', $post['clap'])->first();
        if(empty($censo) == false) 
        {
            Session::flash('message-info', 'El paciente con el CLAP: '.$post['clap'].' ha sido registrado anteriormente.');
            return view('alertas.msjInfo');   
        }
    }

    public function registraIngreso()
    {
        $post = Request::all();
        $cita = Citas31500::find($post['clap']);
        $padron = Padron_Maestro::datosPaciente($cita->clip);
        $servicios = Servicios::lists('descripcion', 'id')->prepend('---SELECCIONA UN SERVICIO---');
        $especial = Especialidad::DescripcionNivel();        
        return view('pacientes.ingreso', compact('cita', 'padron', 'servicios', 'especial'));
    }

    public function medicosEspecial()
    {
        $post = Request::all();
        $clave = $post['clave'];
        $medesp = Medicos::listaMedicosEspecialidad($clave);        
        return view('pacientes.especialistas', compact('medesp'));
    }

    public function buscarCIE10()
    {
        $post = Request::all();
        $dxCie10 = Cie10::MostrarCie10($post['desc']);
        return view('pacientes.cie10', compact('dxCie10'));
    }

    public function pruebas()
    {
        $servicios = Servicios::orderBy('descripcion')->lists('descripcion', 'id')->prepend('---SELECCIONA UN SERVICIO---');
        return view('prueba', compact('servicios'));
        //return response()->json($servicios);
    }
}