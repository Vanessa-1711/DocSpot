<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pacientes_hospitales', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('curp')->unique();
            $table->string('nss')->unique();
            $table->foreignId('hospital_id')->constrained('hospitales');
            $table->foreignId('paciente_id')->nullable()->constrained('pacientes');



        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes_hospitales');
    }
};
