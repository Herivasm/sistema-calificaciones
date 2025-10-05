<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('alumnos', function (Blueprint $table) {
            // Eliminar la columna 'fecha_nacimiento'
            $table->dropColumn('fecha_nacimiento');
        });
    }

    public function down(): void
    {
        Schema::table('alumnos', function (Blueprint $table) {
            // Revertir el cambio (si fuera necesario)
            $table->date('fecha_nacimiento')->nullable();
        });
    }
};
