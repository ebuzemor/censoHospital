<?php

namespace App\MyClasses;

class ListaPermisos {
	
	public static function getOpciones()
	{
		$opciones = array(
			1 => '<li><a href="inicio"><i class="glyphicon glyphicon-home"></i> Inicio</a></li>',
			2 => '<li><a href="#"><i class="glyphicon glyphicon-bed"></i> Ver Hospitalizados</a></li>',
			4 => '<li><a href="#"><i class="glyphicon glyphicon-open"></i> Dar de alta Paciente</a></li>',
			8 => '<li><a href="usuarios"><i class="glyphicon glyphicon-cog"></i> Gestión de usuarios</a></li>'
		);
		return $opciones;
	}

	public static function obtenerPermisos($permisos)
	{
		$opciones = self::getOpciones();
		$indices = array_keys($opciones);
		$perfil = array();
		$inicio = $permisos;
		//Obtiene los indices de las opciones a partir del valor permisos
		if($permisos > 0)
		{			
			$indices = array_reverse($indices);
			for ($i = 0; $i < count($indices); $i++)			
			{
				$ban = $inicio - $indices[$i];
				if($ban >= 0)
				{
					$perfil[$i] = $indices[$i];
					$inicio = $ban;
				}
			}
		}
		else
			$perfil[0] = "ERROR EN LA ASIGNACION DE PRIVILEGIOS";

		//Obtiene el menú a partir del arreglo de opciones en perfil
		$menu = array();
		$perfil = array_reverse($perfil); //Se voltea el arreglo porque se obtienen los valores de manera invertida
		$x = 0;		
		for ($i=0; $i < count($perfil); $i++) { 
			$opcion = $perfil[$i];
			$menu[$i] = $opciones[$opcion];
		}
		return $menu;
	}
}