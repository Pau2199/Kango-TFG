<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tipo_de_via');
            $table->string('localidad');
            $table->string('provincia');
            $table->string('nombre_de_la_direccion');
            $table->string('codigo_postal');
            $table->integer('nPuerta');
            $table->integer('nPatio');
            $table->integer('nPiso');
            $table->string('escalera')->nullable();
            $table->string('bloque')->nullable();
            $table->bigInteger('idInmueble')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('address');
    }
}
