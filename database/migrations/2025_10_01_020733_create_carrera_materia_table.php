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
        Schema::create('carrera_materia', function (Blueprint $table) {
            $table->foreignId('materia_id')->constrained('materias')->onDelete('cascade');
        // Conecta la Carrera
        $table->foreignId('carrera_id')->constrained('carreras')->onDelete('cascade');

        $table->primary(['materia_id', 'carrera_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carrera_materia');
    }
};
