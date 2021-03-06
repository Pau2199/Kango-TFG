<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignToSolicitudeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('solicitude', function (Blueprint $table) {
            $table->foreign('solicitadaAIdUser')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('solicitadaDeIdUser')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('idInmueble')->references('id')->on('property')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('solicitude', function (Blueprint $table) {
            $table->dropForeign('solicitude_solicitadaAIdUser_foreign');
            $table->dropForeign('solicitude_solicitadaDeIdUser_foreign');
            $table->dropForeign('solicitude_idInmueble_foreign');
        });
    }
}
