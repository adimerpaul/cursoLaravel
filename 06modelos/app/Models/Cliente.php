<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'tipo',
        'razon_social',
        'nro_identificacion',
        'telefono',
        'direccion',
        'correo',
        'estado',
    ];
}
