<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFichasMedicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fichas_medicas', function (Blueprint $table) {
            $table->increments('ID');
            $table->unsignedInteger('Paciente_ID');
            $table->unsignedInteger('Medico_ID');
            $table->unsignedInteger('Centromedico_ID');
            $table->date('fecha');
            $table->time('hora');
            $table->integer('nro');
            $table->string('turno');
            $table->string('estado');
            $table->foreign('Paciente_ID')->references('ID')->on('Pacientes');
            $table->foreign('Medico_ID')->references('ID')->on('Medicos');
            $table->foreign('Centromedico_ID')->references('Id')->on('Centros_medicos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fichas_medicas');
    }
}
