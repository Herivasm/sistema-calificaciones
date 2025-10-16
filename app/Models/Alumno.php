<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Alumno extends Model
{
    use HasFactory;

    // CORRECCIÓN CLAVE: Añadimos 'esta_activo' para la desactivación lógica
    protected $fillable = [
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'matricula',
        'carrera_id',
        'ciclo_escolar_id',
        'esta_activo' // NUEVO: Para la desactivación lógica
    ];

    // Opcional pero recomendado: Asegurar que el campo sea booleano
    protected $casts = [
        'esta_activo' => 'boolean',
    ];

    // --- Relaciones de Uno a Muchos (belongsTo) ---

    /**
     * Un Alumno pertenece a una Carrera.
     */
    public function carrera()
    {
        return $this->belongsTo(Carrera::class, 'carrera_id');
    }

    /**
     * Un Alumno pertenece a un Ciclo Escolar.
     */
    public function cicloEscolar()
    {
        return $this->belongsTo(CicloEscolar::class, 'ciclo_escolar_id');
    }

    // --- Relación de Muchos a Muchos (belongsToMany) ---

    /**
     * Un Alumno está matriculado en varios Grupos (para calificar).
     */
    public function grupos()
    {
        return $this->belongsToMany(Grupo::class, 'alumno_grupo', 'alumno_id', 'grupo_id');
    }
}
