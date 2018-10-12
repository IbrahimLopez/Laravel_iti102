<?php

/*  Developed by: Ibrahim Alexis Lopez Roman
    Año: 09/10/2018,
    Materia: Desarrollo de aplicaciones web,
    Maestro: Noe Cazares,
    Descripcion:Clase para validar a los usuarios.
*/

namespace App\Validations;
use Respect\Validation\Validator as v;
use App\Helpers\ResponseHelper;

class UsuarioValidation
{
    public static function validate(array $model)
    {
        try
        {
            $v = v::key('nombre', v::stringType()->notEmpty())
            ->key('apaterno', v::stringType()->notEmpty())
            ->key('amaterno', v::stringType()->notEmpty());
            //Aplica la validacion en el modelo
            $v->assert($model);
        }
        catch(\Exception $e)
        {
            $rh = new ResponseHelper();
            $rh->setResponse(false, null);
            $rh->validations = $e->findMessages([
                'nombre'=> ['Campo Requerido'],
                'apaterno'=> 'Campo Requerido',
                'amaterno'=> 'Campo Requerido'
                ]);
            exit(json_encode($rh));
        }
    }
}