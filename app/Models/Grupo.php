<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;

    // Indica qué campos se pueden guardar masivamente, incluyendo la nueva clave 'carrera_id'
    protected $fillable = ['nombre', 'materia_id', 'cuatrimestre_id', 'carrera_id'];

    // --- Relaciones de Uno a Muchos (belongsTo) ---

    /**
     * Un grupo pertenece a una materia.
     */
    public function materia()
    {
        return $this->belongsTo(Materia::class, 'materia_id');
    }

    /**
     * Un grupo se imparte en un cuatrimestre específico.
     */
    public function cuatrimestre()
    {
        return $this->belongsTo(Cuatrimestre::class, 'cuatrimestre_id');
    }

    /**
     * Un grupo pertenece a una Carrera (necesario para el filtro de alumnos en matriculación).
     */
    public function carrera()
    {
        return $this->belongsTo(Carrera::class, 'carrera_id');
    }

    // --- Relaciones de Muchos a Muchos (belongsToMany) ---

    /**
     * Un grupo tiene muchos alumnos (a través de la tabla pivote 'alumno_grupo').
     */
    public function alumnos()
    {
        // Se define la tabla pivote 'alumno_grupo'
        return $this->belongsToMany(Alumno::class, 'alumno_grupo', 'grupo_id', 'alumno_id');
    }
}
