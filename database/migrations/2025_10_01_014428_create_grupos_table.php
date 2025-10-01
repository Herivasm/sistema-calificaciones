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
        Schema::create('grupos', function (Blueprint $table) {
            $table->id();
               $table->string('nombre'); // Ej: "Grupo 101-A"

        // Relaciones
        $table->foreignId('materia_id')->constrained('materias');
        $table->foreignId('cuatrimestre_id')->constrained('cuatrimestres');
        // Podrías añadir un docente_id aquí si tuvieras una tabla de docentes
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grupos');
    }
};
