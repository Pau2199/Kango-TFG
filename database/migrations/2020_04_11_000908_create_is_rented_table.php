<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIsRentedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('is_rented', function (Blueprint $table) {
            $table->Date('fecha_inicio');
            $table->Date('fecha_final');
            $table->bigInteger('numero_de_cuenta');
            $table->bigInteger('idUsuario')->unsigned();
            $table->bigInteger('idAlquiler')->unsigned();
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
        Schema::dropIfExists('is_rented');
    }
}
