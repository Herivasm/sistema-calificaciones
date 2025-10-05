<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Alumno extends Model
{
    use HasFactory;

    // Le decimos a Laravel qué campos puede guardar
    protected $fillable = [
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'matricula',
        'carrera_id',
        'ciclo_escolar_id'
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
        // Conecta este Alumno con la tabla 'grupos' a través de la tabla pivote 'alumno_grupo'
        return $this->belongsToMany(Grupo::class, 'alumno_grupo', 'alumno_id', 'grupo_id');
    }

}
