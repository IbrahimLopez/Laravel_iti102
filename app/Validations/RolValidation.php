<?php
/*
Autor: Ibrahim Alexis Lopez Roman,
Fecha: Thursday, October, 2018
Hora: 19:27:30
Materia: Desarrollo de aplicaciones,
Maestro: Noe Cazarez,
Descripcion: Clase de validacion de roles
*/
 
namespace App\Validations;

use Respect\Validation\Validator as v;
use App\Helpers\ResponseHelper;

class RolValidation
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