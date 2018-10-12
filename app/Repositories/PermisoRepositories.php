<?php
namespace App\Repositories;


use App\Helpers\ResponseHelper;
use App\Models\Permiso;
use Core\Log;
use Illuminate\Database\Eloquent\Collection;

class PermisoRepositories
{

    private $permiso;
    public function __construct()
    {
        #Se instancia un nuevo permiso          
        $this->permiso= new Permiso();        
    }


    public function listar():?Collection
    {
        $datos = [];
        try
        {
            $datos = $this->permiso->get();
        }
        catch (\Exception $e)
        {
            Log::error(PermisoRepositories::class, $e->getMessage());
        }
        return $datos;
        
    }

    public function guardar($model):ResponseHelper
    {
        $rh = new ResponseHelper();
        try
         {
             $this->permiso=$model;
             if (isset($model->id))
                 $this->permiso->exists = true;
            //  if (isset($this->permiso->password))
            //      $this->permiso->password = sha1($this->model->password);

             $this->permiso->save();
             $rh->setResponse(true, 'Registro guardado con exito');
         } catch (\Exception $e)
         {             
           Log::error(PermisoRepositories::class, $e->getMessage());
         }
        return $rh;
    }
 
    public function obtener($id):?Permiso
    {
        $dato = null;
        try
        {
            $dato = $this->permiso->find($id);                     
        }
        catch(\Exception $e)
        {
            Log::error(PermisoRepositories::class, $e->getMessage(). "Linea: " . $e->getLine());
        }
        return $dato;
    }
    
}
