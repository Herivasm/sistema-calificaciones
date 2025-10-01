<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CicloEscolar extends Model
{
     protected $table = 'ciclo_escolars';
     protected $fillable = ['nombre', 'fecha_inicio', 'fecha_fin', 'esta_activo'];
}
