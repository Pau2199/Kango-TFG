<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignToVisitingHoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('visiting_hours', function (Blueprint $table) {
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
        Schema::table('visiting_hours', function (Blueprint $table) {
            $table->dropForeign('visiting_hours_idUsuario_foreign');
        });
    }
}
