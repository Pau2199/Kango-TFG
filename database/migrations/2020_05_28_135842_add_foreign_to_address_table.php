<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignToAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('address', function (Blueprint $table) {
            $table->foreign('idInmueble')->references('id')->on('property');
            $table->foreign('idProvincia')->references('id')->on('provinces');
            $table->foreign('idLocalidad')->references('id')->on('localities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('address', function (Blueprint $table) {
            $table->dropForeign('address_idInmueble_foreign');
            $table->dropForeign('address_idProvincia_foreign');
            $table->dropForeign('address_idLocalidad_foreign');
        });
    }
}
