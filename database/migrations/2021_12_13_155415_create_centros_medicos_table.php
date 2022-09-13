<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCentrosMedicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('centros_medicos', function (Blueprint $table) {
            $table->increments('ID');
            $table->unsignedInteger('User_ID');
            $table->string('nivel');
            $table->string('fotografia')->nullable();
            $table->string('nombre');
            $table->string('direccion');
            $table->string('telefono');
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
        Schema::dropIfExists('centros_medicos');
    }
}
