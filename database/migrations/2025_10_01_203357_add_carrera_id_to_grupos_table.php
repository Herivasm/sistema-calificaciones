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
        Schema::table('grupos', function (Blueprint $table) {
              // Añadir la clave foránea a la tabla 'carreras'
            $table->foreignId('carrera_id')
                  ->after('cuatrimestre_id') // Posición opcional: después de cuatrimestre_id
                  ->constrained('carreras')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('grupos', function (Blueprint $table) {
            $table->dropConstrainedForeignId('carrera_id');
        });
    }
};
