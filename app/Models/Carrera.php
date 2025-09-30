<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
  use HasFactory;

class Carrera extends Model
{



    protected $fillable = ['nombre', 'descripcion'];
}
