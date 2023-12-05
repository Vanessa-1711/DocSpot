<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeHoraColumnInCitasTable extends Migration
{
    public function up()
    {
        Schema::table('citas', function (Blueprint $table) {
            $table->time('hora')->change();
        });
    }

    public function down()
    {
        Schema::table('citas', function (Blueprint $table) {
            // Si es necesario revertir los cambios, puedes volver al tipo datetime
            $table->datetime('hora')->change();
        });
    }
}

