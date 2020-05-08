<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignToIsRentedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('is_rented', function (Blueprint $table) {
            $table->foreign('idAlquiler')->references('id')->on('rental')->onDelete('cascade');
            $table->foreign('idUsuario')->references('dni')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('is_rented', function (Blueprint $table) {
            $table->dropForeign('is_rented_idAlquiler_foreign');
            $table->dropForeign('is_rented_idUsuario_foreign');
        });
    }
}
