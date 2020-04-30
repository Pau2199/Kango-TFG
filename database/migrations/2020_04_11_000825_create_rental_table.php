<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rental', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('internet');
            $table->boolean('animales');
            $table->boolean('reformas');
            $table->boolean('calefaccion');
            $table->boolean('aireAcondicionado');
            $table->bigInteger('fianza');
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
        Schema::dropIfExists('rental');
    }
}
