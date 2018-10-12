<?php

namespace Core;

use Illuminate\Database\Capsule\Manager as Capsule;
class DbContext
{
    //Inicializa la base de datos
    public static  function initialize(){
        try
        {
         $config = ServicesContainer::getConfig(); //Obtiene la configuracion de la base de datos
         $capsule = new Capsule(); //Se instancia un objeto de tipo Capsule(Manager)
         $capsule->addConnection($config['database']); //Agrega la conexion de la base de datos
         $capsule->setAsGlobal();
         $capsule->bootEloquent();
        }
        catch (\Exception $e)
        {
            Log::error(DbContext::class,$e->getMessage()); //En caso de error  crea un registro
        }
    }
}