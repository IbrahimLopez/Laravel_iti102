<?php
/**
 * Created by PhpStorm.
 * User: ibrah
 * Date: 18/09/2018
 * Time: 08:38 AM
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Usuario extends  Model
{
    protected $table = 'usuarios';
    public function rol(){
        return $this->belongsTo('App\Models\Rol');
    }
}