<?php

namespace App\Http\Controllers; 

use App\User;
use App\Http\Requests;
use App\MyClasses\RutasIconos;
use App\Models\Cie10;
use App\Models\Medicos;
use App\Models\Servicios;
use App\Models\Citas31500;
use App\Models\Especialidad;
use App\Models\Padron_Maestro;
use App\Models\CensoHospital31500;
use App\Http\Requests\AltaPacRequest;
use App\Http\Requests\CensoHospitalRequest;
use Auth;
use Session;
use Request;
use Response;
use DateTime;

class CensoController extends Controller
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
        $titulo = 'Censo de Pacientes';
    	return view('censo.index', compact('ltarutas', 'titulo'));
    }

    public function actualizaCenso(CensoHospitalRequest $request)
    {
        try{
            $post = $request->all();
            $censo = CensoHospital31500::where('clap', $post['clap'])->first();
            $censo->fill($post)->save();
        }catch(\Exception $e) {
            Session::flash('message-error', 'Error al actualizar al paciente con CLAP: '.$post['clap'].'; descripción del error: '.$e->getMessage());
            return view('alertas.msjError');
        }
        Session::flash('message', 'El paciente fue actualizado correctamente');
        return view('alertas.msjExito');
    }

    public function store(AltaPacRequest $request)
    {
        $post = $request->all();        
        $censo = CensoHospital31500::find($post['idPac']);
        $censo->dx_salida = $post['dx_salida'];
        $censo->motivo = $post['motivo'];
        $censo->fecha_salida = $post['fecha_salida'];
        $censo->cedula_alta = $post['cedula_alta'];
        $fsalida = new DateTime(date('Y-m-d', strtotime($censo->fecha_salida))); //de esta manera se ignora las hrs, min, y seg en la resta
        $fingreso = new DateTime(date('Y-m-d', strtotime($censo->fecha_ingreso)));
        $censo->duracion = $fsalida->diff($fingreso)->format('%a dias');
        $censo->save();
        Session::flash('message', 'El paciente con el CLAP: '.$censo->clap.' ha sido dado de Alta correctamente');        
    }

    public function verPacientes()
    {
        $post = Request::all();
        $fecini = $post['fecini'];
        $fecfin = $post['fecfin'];
        $lista = CensoHospital31500::mostrarPacientes($fecini, $fecfin);
        $servicios = Servicios::orderBy('descripcion')->lists('descripcion', 'id')->prepend('---SELECCIONA UN SERVICIO---');
        $medicos = Medicos::listaMedicos31500();
        return view('censo.consulta', compact('lista', 'servicios', 'medicos'));
    }

    public function verRecientes()
    {
        $lista = CensoHospital31500::ultimosCensados();
        $servicios = Servicios::orderBy('descripcion')->lists('descripcion', 'id')->prepend('---SELECCIONA UN SERVICIO---');
        $medicos = Medicos::listaMedicos31500();
        return view('censo.consulta', compact('lista', 'servicios', 'medicos'));
    }

    public function infoPaciente()
    {
        $post = Request::all();
        $clap = $post['clap'];
        $infoPac = CensoHospital31500::detallesPaciente($clap);
        //return view('prueba', compact('infoPac'));
        return view('censo.infomodal', compact('infoPac'));
    }

    public function editPaciente()
    {
        $post = Request::all();
        $clap = $post['clap'];
        $cita = Citas31500::find($clap);
        $padron = Padron_Maestro::datosPaciente($cita->clip);
        $censo = CensoHospital31500::where('clap', $clap)->first();
        $turno = array(['clv'=>'Mat', 'desc'=>'Matutino'], ['clv'=>'Ves', 'desc'=>'Vespertino'], ['clv'=>'Noc', 'desc'=>'Nocturno']);
        $origen = array(['clv'=>0, 'desc'=>'---Elija un Origen de Ingreso---'], 
                        ['clv'=>1, 'desc'=>'Consulta Externa'], 
                        ['clv'=>2, 'desc'=>'Urgencias'], 
                        ['clv'=>3, 'desc'=>'Canalizado de otra Unidad']);
        $servicios = Servicios::lists('descripcion', 'id')->prepend('---SELECCIONA UN SERVICIO---');
        $especial = Especialidad::DescripcionNivel();
        $medico = Medicos::where('cedula', $censo->cedula)->first();
        $cie10 = Cie10::where('codigo', $censo->dx_entrada)->first();
        //return view('prueba', compact('medico'));
        return view('censo.editaingreso', compact('cita', 'padron', 'servicios', 'especial', 'censo', 'origen', 'turno', 'medico', 'cie10'));
    }

    public function pruebas()
    {
        //$post = Medicos::listaMedicos31500();
        $fecha = new DateTime();
        $post = date('Y-m-d', strtotime('2016-08-16 09:31:04'));
        return view('prueba', compact('post'));
    }
}
