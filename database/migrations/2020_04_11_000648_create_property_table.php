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
            $table->bigInteger('metros_cuadrados');
            $table->bigInteger('precio');
            $table->string('tipo_de_vivienda');
            $table->string('descripcion')->nullable();
            $table->boolean('piscina');
            $table->boolean('ascensor');
            $table->boolean('garage');
            $table->bigInteger('n_habitaciones');
            $table->bigInteger('n_cuartos_de_banyo');
            $table->string('idUsuario');
            $table->boolean('disponible');
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
