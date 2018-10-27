<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rol extends Model
{
    use SoftDeletes; //Libreria de eliminado 'suave'
    protected  $table = 'roles';

    public function usuario(){
        return $this->hasMany('App\Models\Usuario');
    }

    public function permiso_negado(){
        return $this->hasMany('App\Models\PermisoNegado');
    }
}