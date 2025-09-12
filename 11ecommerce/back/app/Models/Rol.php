<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Permiso;

class Rol extends Model
{
    protected $table = 'roles';
    protected $fillable = ['nombre', 'descripcion'];
    function permisos()
    {
        return $this->belongsToMany(Permiso::class, 'permiso_role', 'role_id', 'permiso_id');
    }
}
