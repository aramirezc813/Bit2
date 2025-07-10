<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Componentes_Estacion extends Model
{
    use HasFactory;
    
    protected $fillable=['id','descripcion'];
}
