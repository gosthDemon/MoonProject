<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->increments('ID');
            $table->unsignedInteger('User_ID');
            $table->unsignedInteger('Barrio_ID');
            $table->string('fotografia')->nullable();
            $table->string('nombre');
            $table->string('apellidos');
            $table->string('carnet');
            $table->date('fecha_nacimiento');
            $table->string('telefono');
            $table->string('direccion');
            $table->integer('strikes');
            $table->foreign('User_ID')->references('ID')->on('users');
            $table->foreign('Barrio_ID')->references('ID')->on('barrios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pacientes');
    }
}
