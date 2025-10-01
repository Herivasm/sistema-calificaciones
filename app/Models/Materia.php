<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    use HasFactory;

    // Solo necesitamos 'nombre' ya que eliminaste 'creditos' y la clave foránea 'carrera_id'.
    protected $fillable = ['nombre'];

    // --- Relaciones de Muchos a Muchos ---

    /**
     * Una Materia pertenece a muchas Carreras.
     * Esta relación usa la tabla pivote 'carrera_materia'.
     */
    public function carreras()
    {
        return $this->belongsToMany(Carrera::class, 'carrera_materia', 'materia_id', 'carrera_id');
    }

    // --- Relaciones de Uno a Muchos ---

    /**
     * Una Materia puede tener varios Grupos.
     */
    public function grupos()
    {
        return $this->hasMany(Grupo::class, 'materia_id');
    }
}
