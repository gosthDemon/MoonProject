<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDerivacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('derivaciones', function (Blueprint $table) {
            $table->increments('ID');
            $table->unsignedInteger('Paciente_ID');
            $table->unsignedInteger('Medico_Origen');
            $table->unsignedInteger('Centromedico_Origen');
            $table->unsignedInteger('Especialidad_ID');
            $table->date('fecha_inicio');
            $table->date('fecha_final');
            $table->foreign('Paciente_ID')->references('ID')->on('Pacientes');
            $table->foreign('Medico_Origen')->references('ID')->on('Medicos');
            $table->foreign('Centromedico_Origen')->references('ID')->on('Centros_medicos');
            $table->foreign('Especialidad_ID')->references('ID')->on('Especialidades');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('derivaciones');
    }
}
