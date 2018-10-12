<?php

namespace App\Repositories;

use App\Models\Rol;
use Core\Log;
use Illuminate\Database\Eloquent\Collection;

class RolRepositories
{
    private $rol;
     public function __construct()
     {
         $this->rol = new Rol();
     }

     public function listar():Collection
     {
         $datos =[];
         try
         {
             $datos =  $this->rol->get();
         }
         catch (\Exception $e)
         {
             Log::error(RolRepositories::class, $e->getMessage());
         }
         return $datos;
     }

     public function obtener($id):Rol
     {
         $model= new Rol();
         try
         {
             $model =  $this->rol
                         ->where('id', $id)
                         ->get()
                         ->first();
         }
         catch (\Exception $e)
         {
             Log::error(RolRepositories::class, $e->getMessage());
         }
         return $model;
     }
}