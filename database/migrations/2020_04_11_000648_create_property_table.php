<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('metros_cuadrdados');
            $table->string('localidad');
            $table->string('provincia');
            $table->string('tipo_de_via');
            $table->string('nombre_de_la_direccion');
            $table->string('codigo_postal');
            $table->bigInteger('precio');
            $table->string('tipo_de_vivienda');
            $table->string('descripcion');
            $table->boolean('piscina');
            $table->boolean('ascensor');
            $table->boolean('garaje');
            $table->bigInteger('n_habitaciones');
            $table->bigInteger('n_cuartos_de_banyo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('property');
    }
}
