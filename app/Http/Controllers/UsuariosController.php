<?php
namespace App\Http\Controllers;

use Auth;
use Session;
use App\User;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\MyClasses\RutasIconos;
use App\Http\Requests\RegistroRequest;
use App\Http\Requests\ActualizaRequest;

class UsuariosController extends Controller
{
	function __construct()
    {
    	$this->middleware('auth');    	
    }

    public function index()
    {
        $lista = User::all();
        $ltarutas = new RutasIconos;
        $ltarutas->rutas = MenuController::rutas(Auth::User()->permisos);
        $ltarutas->iconos = MenuController::iconos(Auth::User()->permisos);
        $titulo = 'Lista de Usuarios';
        return view('usuarios.index', compact('ltarutas', 'lista', 'titulo'));
    }

    public function show() {}

    public function store(RegistroRequest $request)
    {
    	$post = $request->all();
        $post['password'] = bcrypt($post['password']);

        $usuario = new User;
        
        if(!isset($post['permisos']))
            $post['permisos'] = 1;
        else {
            $permisos = 1;
            foreach ($post['permisos'] as $priv) {
                $permisos += $priv;
            }
            $post['permisos'] = $permisos;
        }

        $usuario->fill($post)->save();
        return redirect('usuarios');
    }

    public function update(ActualizaRequest $request, $id)
    {
        Session::flash('message','Usuario Actualizado Correctamente');
    	$post = $request->all();
        $post['password'] = bcrypt($post['password']);
        //return view('prueba', compact('post'));        
        if(!isset($post['permisos']))
            $post['permisos'] = 1;
        else {
            $permisos = 1;
            foreach ($post['permisos'] as $priv) {
                $permisos += $priv;
            }
            $post['permisos'] = $permisos;
        }

        $usuario = User::find($id);
        $usuario->fill($post)->save();
        return redirect('usuarios');
    }

    public function edit($id)
    {        
        $usuario = User::find($id);
        $ltarutas = new RutasIconos;
        $ltarutas->rutas = MenuController::rutas(Auth::User()->permisos);
        $ltarutas->iconos = MenuController::iconos(Auth::User()->permisos);
        $chkText = array(2=>'Pacientes Hospitalizados', 4=>'Censo Pacientes H.', 8=>'Registrar Alta Paciente', 16=>'Gestión de Usuarios');
        $ltaperm = MenuController::permisos($chkText, $usuario->permisos);
        //return view('prueba', compact('chkText'));
        $titulo = 'Editando usuarios';
    	return view('usuarios.edit', compact('usuario', 'lista', 'ltarutas', 'ltaperm', 'chkText', 'titulo'));
    }    

    public function destroy($id)
    {
        $usuario = User::find($id);
    	$usuario->delete();
        Session::flash('message','Usuario Eliminado Correctamente');
        return redirect('usuarios');
    }   
}