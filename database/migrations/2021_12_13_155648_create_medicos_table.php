<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicos', function (Blueprint $table) {
            $table->increments('ID');
            $table->unsignedInteger('User_ID');
            $table->unsignedInteger('Especialidad_ID');
            $table->unsignedInteger('Centromedico_ID');
            $table->string('fotografia')->nullable();
            $table->string('nombre');
            $table->string('apellidos');
            $table->string('carnet');
            $table->date('fecha_nacimiento');
            $table->string('telefono');
            $table->string('fichas');
            $table->foreign('Centromedico_ID')->references('ID')->on('Centros_Medicos');
            $table->foreign('Especialidad_ID')->references('ID')->on('Especialidades');
            $table->foreign('User_ID')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medicos');
    }
}
