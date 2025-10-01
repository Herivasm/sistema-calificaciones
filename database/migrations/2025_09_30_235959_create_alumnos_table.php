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
        Schema::create('alumnos', function (Blueprint $table) {
            $table->id();
              $table->string('nombre');
            $table->string('apellido');
            $table->string('matricula')->unique(); // Clave única del alumno
            $table->date('fecha_nacimiento')->nullable();

            // Claves Foráneas (Relaciones)
            // 1. Relación con Carreras
            $table->foreignId('carrera_id')
                  ->constrained('carreras') // Se enlaza con la tabla 'carreras'
                  ->onDelete('cascade');    // Si se borra la carrera, se borran los alumnos asociados.

            // 2. Relación con Ciclo Escolar
            $table->foreignId('ciclo_escolar_id')
                  ->constrained('ciclo_escolars') // Se enlaza con la tabla 'ciclo_escolars'
                  ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumnos');
    }
};
