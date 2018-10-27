<?php
namespace App\Repositories;


use Core\Log;
use App\Models\Permiso;
use App\Models\PermisoNegado;
use App\Helpers\ResponseHelper;
use Illuminate\Database\Eloquent\Collection;

class PermisoRepositories
{

    private $permiso;
    private $permisoNegado;
    public function __construct()
    {
        #Se instancia un nuevo permiso          
        $this->permiso= new Permiso();   
        #Se instancia un nuevo permiso negado     
        $this->permisoNegado= new PermisoNegado();   
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

             $this->permiso->save();
             $rh->setResponse(true, 'Operacion realizada con exito');
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


    #region: Permisos negados
        public function  obtenerPermisoNegadoByRol($permisoId, $rolId):?PermisoNegado
        {
            $pNegado = null;
            try
            {
                $pNegado = $this->permisoNegado->where('permiso_id', $permisoId)->where('rol_id', $rolId)->first();
            }
            catch(\Exception $e)
            {
                Log::error(PermisoRepositories::class, $e->getMessage(). "Linea: " . $e->getLine());
            }
            return pNegado;
        }
    #endregion
    
}
