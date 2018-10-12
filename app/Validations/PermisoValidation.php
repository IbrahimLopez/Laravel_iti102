<?php
/*
Autor: Ibrahim Alexis Lopez Roman,
Fecha: Wednesday, October, 2018
Hora: 22:48:26
Materia: Desarrollo de aplicaciones,
Maestro: Noe Cazarez,
Descripcion: Clase para validad a los permisos
*/
 
namespace App\Validations;

use Respect\Validation\Validator as v;
use App\Helpers\ResponseHelper;


class PermisoValidation 
{
    public static function validate(array $model)
    {
        try
        {
            $v = v::key('nombre', v::stringType()->notEmpty());          
            //Aplica la validacion en el modelo
            $v->assert($model);
        }
        catch(\Exception $e)
        {
            $rh = new ResponseHelper();
            $rh->setResponse(false, null);
            $rh->validations = $e->findMessages([
                'nombre'=> 'Campo Requerido'
                ]);
            exit(json_encode($rh));
        }
    }
}