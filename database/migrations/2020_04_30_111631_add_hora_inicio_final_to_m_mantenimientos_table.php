<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHoraInicioFinalToMMantenimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('m_mantenimientos', function (Blueprint $table) {
            $table->time('hora_inicio')->default('00:00:00');
            $table->time('hora_fin')->default('00:00:00');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('m_mantenimientos', function (Blueprint $table) {
            //
        });
    }
}
