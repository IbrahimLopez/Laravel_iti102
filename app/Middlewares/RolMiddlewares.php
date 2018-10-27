<?php
/*
Autor: Ibrahim Alexis Lopez Roman,
Fecha: Tuesday, October, 2018
Hora: 08:14:41
Materia: Desarrollo de aplicaciones,
Maestro: Noe Cazarez,
Descripcion: Funciones intermedias para identificar el rol
*/
 
namespace App\Middlewares;

use Core\Auth;
use App\Repositories\PermisoRepositories;

class RolMiddlewares
{

   public static function isRoot():bool{
       $resp = false;
       if (Auth::getCurrentUser()->rol_id==1000) 
            $resp = true;
       
       return $resp;
   }

   public static function isAdmin():bool{
       $resp = false;
       if (Auth::getCurrentUser()->rol_id==1) 
         $resp = true;
       
       return $resp;
   }
   
   public static function isMaestro():bool{
        $resp = false;
        if (Auth::getCurrentUser()->rol_id==2) 
            $resp = true;
        
        return $resp;
   }

   public static function isAlumno():bool{
    $resp = false;
    if (Auth::getCurrentUser()->rol_id==3) 
        $resp = true;

    return $resp;
   }

   public static function tienesPermiso($permisoId):bool
   {
       $resp = false;
       $dato (new PermisoRepositories())->obtenerPermisoNegadoByRol($permisoId, Auth::getCurrentUser()->rol_id);
       if (!is_object($dato)) {
           $resp = true;
       }
       return resp;
   }
    




}