<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitude', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->Date('fecha_solicitada');
            $table->String('hora');
            $table->String('estado');
            $table->bigInteger('solicitadaAIdUser')->unsigned();
            $table->bigInteger('solicitadaDeIdUser')->unsigned();
            $table->bigInteger('idInmueble')->unsigned();
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
        Schema::dropIfExists('solicitude');
    }
}
