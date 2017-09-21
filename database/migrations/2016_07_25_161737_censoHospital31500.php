<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CensoHospital31500 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('censo_Hospital_31500', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('clap')->unique();
            $table->string('cama', 10);
            $table->string('dx_entrada', 10);
            $table->string('dx_salida', 10);
            $table->char('turno', 5);
            $table->string('especialidad', 6);
            $table->string('cedula', 20);
            $table->string('cedula_alta', 20);
            $table->integer('tipo_svc');
            $table->integer('origen_ingreso');
            $table->dateTime('fecha_ingreso');
            $table->dateTime('fecha_salida');
            $table->string('duracion', 15);
            $table->text('motivo');
            $table->string('ocupacion', 50);
            $table->string('telefono', 20);
            $table->string('nom_familiar', 100);
            $table->string('tel_familiar', 20);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('censo_Hospital_31500');
    }
}
