<?php
/**
 * Created by PhpStorm.
 * User: ibrah
 * Date: 18/09/2018
 * Time: 08:43 AM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Permiso extends Model
{
    use SoftDeletes; //Libreria de eliminado 'suave'
    protected $table = 'permisos';

    public function negado(){
        return $this->hasMany('App\Models\PermisoNegado');
    }
}