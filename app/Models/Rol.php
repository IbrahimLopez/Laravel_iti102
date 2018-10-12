<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected  $table = 'roles';
    public function usuario(){
        return $this->hasMany('App\Models\Usuario');
    }

    public function permiso_negado(){
        return $this->hasMany('App\Models\PermisoNegado');
    }
}