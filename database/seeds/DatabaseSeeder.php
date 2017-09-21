<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('usuarios_Trabajo_Social')->insert([
        	'nombre'	=> 'Administrador',
        	'apellidos'	=> 'General',
        	'email'		=> 'admin@correo.mx',
        	'usuario'	=> 'admin',
        	'permisos'	=> '31',
        	'password'	=> bcrypt('admin'),
        ]);
    }
}
