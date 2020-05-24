<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignToFavoriteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('favorite', function (Blueprint $table) {
            $table->foreign('idUser')->references('id')->on('users')->onDelete('cascade');
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
        Schema::table('favorite', function (Blueprint $table) {
            $table->dropForeign('favorite_idUser_foreign');
            $table->dropForeign('favorite_idInmueble_foreign');
        });
    }
}
