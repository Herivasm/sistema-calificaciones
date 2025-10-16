<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;

    // CORRECCIÓN: Añadimos 'esta_activo'
    protected $fillable = ['nombre', 'materia_id', 'cuatrimestre_id', 'carrera_id', 'esta_activo'];

    // CLAVE: Asegura que el valor de la base de datos sea tratado como booleano
    protected $casts = [
        'esta_activo' => 'boolean',
    ];

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
     * Un grupo pertenece a una Carrera.
     */
    public function carrera()
    {
        return $this->belongsTo(Carrera::class, 'carrera_id');
    }

    /**
     * Un grupo tiene muchos alumnos (a través de la tabla pivote 'alumno_grupo').
     */
    public function alumnos()
    {
        return $this->belongsToMany(Alumno::class, 'alumno_grupo', 'grupo_id', 'alumno_id');
    }
}
