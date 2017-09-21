<?php

namespace App\Http\Controllers;

use Auth;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\MyClasses\RutasIconos;


class MenuController extends Controller
{
    function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
        $ltarutas = new RutasIconos;
        $ltarutas->rutas = $this->rutas(Auth::User()->permisos);
        $ltarutas->iconos = $this->iconos(Auth::User()->permisos);
        $titulo = 'Censo Hospitalizados';
        return view('layout.master', compact('ltarutas', 'titulo'));
    }

    public static function rutas($permisos)
    {
        $rutas = array(
            1 => 'inicio',
            2 => 'hospital',
            4 => 'censo',
            8 => 'altapac',
            16 => 'usuarios'
        );
        $menu = self::permisos($rutas, $permisos);
        return $menu;
    }

    public static function iconos($permisos)
    {
        $iconos = array(
            1 => '<i class="glyphicon glyphicon-home"></i> Inicio',
            2 => '<i class="glyphicon glyphicon-bed"></i> Pacientes Hospitalizados',
            4 => '<i class="glyphicon glyphicon-list-alt"></i> Censo Pacientes H.',
            8 => '<i class="glyphicon glyphicon-open"></i> Pacientes dados de Alta',
            16 => '<i class="glyphicon glyphicon-cog"></i> Gestión de usuarios'
        );
        $menu = self::permisos($iconos, $permisos);
        return $menu;
    }

    public static function permisos($arreglo, $permisos)
    {
        $indices = array_keys($arreglo);
        $perfil = array();
        $lista = array();
        $inicio = $permisos; 
        if($permisos > 0)
        {
            $indices = array_reverse($indices);
            for ($i=0; $i < count($indices); $i++) { 
                $ban = $inicio - $indices[$i];
                if($ban >= 0)
                {
                    $perfil[$i] = $indices[$i];
                    $inicio = $ban;
                }
            }
            $perfil = array_reverse($perfil);            
            for ($i=0; $i < count($perfil); $i++) { 
                $x = $perfil[$i];
                $lista[$x] = $arreglo[$x];
            }
        }
        return $lista;
    }
}
