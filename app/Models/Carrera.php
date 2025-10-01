<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    use HasFactory;

    // Indica qué campos se pueden guardar (como lo dejaste)
    protected $fillable = ['nombre', 'descripcion'];

    // --- Relaciones de Muchos a Muchos ---

    /**
     * Una Carrera tiene muchas Materias.
     * Esta relación usa la tabla pivote 'carrera_materia'.
     */
    public function materias()
    {
        // Se define la tabla pivote 'carrera_materia'
        return $this->belongsToMany(Materia::class, 'carrera_materia', 'carrera_id', 'materia_id');
    }

    // --- Relación con Alumnos (que ya tenías) ---

    /**
     * Una Carrera tiene muchos Alumnos.
     */
    public function alumnos()
    {
        // Se asume que el ID de la carrera está en la tabla alumnos
        return $this->hasMany(Alumno::class, 'carrera_id');
    }
}
