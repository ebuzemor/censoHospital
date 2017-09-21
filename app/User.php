<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use SoftDeletes;
    
    protected $dates = ['deleted_at'];
    protected $table = 'usuarios_Trabajo_Social';
    protected $fillable =[
        'id',
        'nombre',
        'apellidos',
        'email',
        'usuario',
        'password',
        'permisos'
    ];
    protected $hidden = [
        'password'
    ];

    public function getNombreCompletoAttribute()
    {
        return $this->attributes['nombre'].' '.$this->attributes['apellidos'];
    }
}
