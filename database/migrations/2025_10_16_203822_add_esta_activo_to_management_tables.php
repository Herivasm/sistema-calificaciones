<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $tables = ['carreras', 'materias', 'alumnos', 'grupos'];

        foreach ($tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                // Añade la columna booleana con valor por defecto TRUE (activo)
                $table->boolean('esta_activo')->default(true);
            });
        }
    }

    public function down(): void
    {
        $tables = ['carreras', 'materias', 'alumnos', 'grupos'];

        foreach ($tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                // Elimina la columna
                $table->dropColumn('esta_activo');
            });
        }
    }
};
