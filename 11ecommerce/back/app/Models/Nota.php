<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    protected $fillable = [
        'fecha',
        'tipo_nota',
        'impuestos',
        'descuento',
        'total_calculado',
        'estado_nota',
        'observaciones',
        'user_id',
        'cliente_id'
    ];
}
