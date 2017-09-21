<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UsuariosTrabajoSocial extends Model
{
    use SoftDeletes;
    
    protected $dates = ['deleted_at'];
    protected $table = 'usuarios_Trabajo_Social';
    protected $fillable =[
    	'id',
    	'nombre',
    	'apellidos',
    	'email',
    	'nickname',
    	//'password'
    ];
    protected $hidden = [
    	'password'
    ];

    public function getNombreCompletoAttribute()
    {
        return $this->attributes['nombre'].' '.$this->attributes['apellidos'];
    }
}
