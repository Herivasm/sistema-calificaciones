<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cuatrimestre extends Model
{
     protected $fillable = ['nombre', 'fecha_inicio', 'fecha_fin', 'esta_activo'];
}
