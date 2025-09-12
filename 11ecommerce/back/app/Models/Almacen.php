<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Almacen extends Model
{
    protected $table = 'almacenes';
    protected $fillable = ['nombre', 'codigo', 'descripcion', 'sucursal_id'];
}
