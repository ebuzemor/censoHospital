<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests;
use App\Models\Cie10;
use App\Models\Servicios;
use App\Models\Citas31500;
use App\MyClasses\RutasIconos;
use App\Models\Padron_Maestro;
use App\Models\CensoHospital31500;
use App\Http\Requests\AltaPacRequest;
use App\Http\Requests\CensoHospitalRequest;
use Auth;
use Session;
use Request;
use Response;
use DateTime;

class AltaPacientesController extends Controller
{
    function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
    	//$lista = CensoHospital31500::altaPacientes();
        $ltarutas = new RutasIconos;
        $ltarutas->rutas = MenuController::rutas(Auth::User()->permisos);
        $ltarutas->iconos = MenuController::iconos(Auth::User()->permisos);
        $titulo = 'Pacientes dados de Alta';
    	return view('altapac.index', compact('ltarutas', 'titulo'));
    }

    public function buscarCIE10def()
    {
        $post = Request::all();
        $dxCie10 = Cie10::MostrarCie10($post['desc']);
        return view('censo.ciedef', compact('dxCie10'));
    }

    public function buscarPacientes()
    {
        $post = Request::all();
        $fecini = $post['fecini'];
        $fecfin = $post['fecfin'];
        $lista = CensoHospital31500::mostrarAltaPacientes($fecini, $fecfin);
        return view('altapac.consulta', compact('lista'));
    }

    public function ultimosPacientes()
    {
        $lista = CensoHospital31500::ultimosPacientes();
        return view('altapac.consulta', compact('lista'));
    }

    public function modalPaciente()
    {
        $post = Request::all();
        $lista = CensoHospital31500::detallesPaciente($post['clap']);
        //return view('prueba', compact('lista'));
        return view('altapac.infomodal', compact('lista'));
    }
}
