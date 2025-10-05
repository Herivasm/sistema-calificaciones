<?php

// En database/migrations/..._update_alumnos_names_fields.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('alumnos', function (Blueprint $table) {
            // 1. Eliminar el campo 'apellido' antiguo
            $table->dropColumn('apellido');

            // 2. Añadir los campos nuevos
            $table->string('apellido_paterno')->after('nombre');
            $table->string('apellido_materno')->after('apellido_paterno')->nullable(); // El materno puede ser opcional
        });
    }

    public function down(): void
    {
        Schema::table('alumnos', function (Blueprint $table) {
            // Al hacer rollback, revertimos al estado original:
            $table->dropColumn('apellido_paterno');
            $table->dropColumn('apellido_materno');
            $table->string('apellido'); // Restauramos el campo antiguo (opcional, pero buena práctica)
        });
    }
};
