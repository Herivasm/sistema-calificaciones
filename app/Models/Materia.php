<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    use HasFactory;

    // CORRECCIÓN: 'esta_activo' DEBE estar en $fillable para ser actualizado
    protected $fillable = ['nombre', 'esta_activo'];

    // CLAVE: Asegura que el valor de la base de datos sea tratado como booleano (true/false)
    protected $casts = [
        'esta_activo' => 'boolean',
    ];

    /**
     * Una Materia pertenece a muchas Carreras.
     */
    public function carreras()
    {
        return $this->belongsToMany(Carrera::class, 'carrera_materia', 'materia_id', 'carrera_id');
    }

    /**
     * Una Materia puede tener varios Grupos.
     */
    public function grupos()
    {
        return $this->hasMany(Grupo::class, 'materia_id');
    }
}
