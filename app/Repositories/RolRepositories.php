<?php

namespace App\Repositories;

use Core\Log;
use App\Models\Rol;
use App\Helpers\ResponseHelper;
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

     public function guardar($model):ResponseHelper
    {
        $rh = new ResponseHelper();
        try
         {
             $this->rol=$model;
             if (isset($model->id))
                 $this->rol->exists = true;

             $this->rol->save();
             $rh->setResponse(true, 'Operacion realizada con exito');
         } catch (\Exception $e)
         {             
           Log::error(RolRepositories::class, $e->getMessage());
         }
        return $rh;
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