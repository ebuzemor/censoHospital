<?php
Route::auth();
Route::get('/', 'MenuController@index');
Route::get('inicio', 'MenuController@index');
Route::resource('usuarios', 'UsuariosController');
Route::get('hospital','PacientesController@index');
Route::post('consulta', 'PacientesController@consulta');
Route::post('consulta_hoy', 'PacientesController@consulta_hoy');
Route::post('checarClap', 'PacientesController@checarClap');
Route::post('agregarCenso', 'PacientesController@agregarCenso');
Route::post('registraIngreso', 'PacientesController@registraIngreso');
Route::post('medicosEspecial', 'PacientesController@medicosEspecial');
Route::post('buscarCIE10', 'PacientesController@buscarCIE10');
Route::resource('censo', 'CensoController', ['only'=>['index', 'store']]);
Route::post('verPacientes', 'CensoController@verPacientes');
Route::post('verRecientes', 'CensoController@verRecientes');
Route::post('infoPaciente', 'CensoController@infoPaciente');
Route::post('editPaciente', 'CensoController@editPaciente');
Route::post('actualizaCenso', 'CensoController@actualizaCenso');
Route::get('altapac', 'AltaPacientesController@index');
Route::post('buscarCIE10def', 'AltaPacientesController@buscarCIE10def');
Route::post('ultimosPacientes', 'AltaPacientesController@ultimosPacientes');
Route::post('buscarPacientes', 'AltaPacientesController@buscarPacientes');
Route::post('modalPaciente', 'AltaPacientesController@modalPaciente');
Route::get('pruebas', 'PacientesController@pruebas');
//Route::match(['put', 'patch'],'altaPaciente/{id}', ['as'=>'censo.alta','uses'=>'CensoController@altaPaciente']);
/*Route::get('detallesPac/{clap}', 'CensoController@registrarDetalles');*/