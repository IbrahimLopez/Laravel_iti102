<?php
/*  Developed by: Ibrahim Alexis Lopez Roman
    Año: 26/09/2018,
    Materia: Desarrollo de aplicaciones,
    Maestro: Noe Cazarez,
    Descripcion: Codigo para el manejo de los datos en la tabla de usuarios
*/

namespace App\Repositories;


use Core\Log;
use Core\Auth;
use App\Models\Usuario;
use App\Helpers\ResponseHelper;
use App\Repositories\UsuarioRepositories;
use Illuminate\Database\Eloquent\Collection;

/*  Developed by: Ibrahim Alexis Lopez Roman
    Año: 28/09/2018, 
    Materia: Desarrollo de aplicaciones, 
    Maestro: Noe Cazarez, 
    Descripcion: Repositorio de usuarios
*/

class UsuarioRepositories
{
    private $usuario;
    public function __construct()
    {
        #Se instancia un nuevo usuario          
        $this->usuario= new Usuario();        
    }

    public function listar():Collection
    {
        $datos = [];
        try
        {
            $datos = $this->usuario->get();
        }
        catch (\Exception $e)
        {
            Log::error(UsuarioRepositories::class, $e->getMessage());
        }
        return $datos;
        
    }

    public function guardar($model):ResponseHelper
    {
        $rh = new ResponseHelper();
        try
         {
             $this->usuario=$model;
             if (isset($model->id))
                 $this->usuario->exists = true;
             if (isset($this->usuario->password))
                 $this->usuario->password = sha1($this->model->password);

             $this->usuario->save();
             $rh->setResponse(true, 'Registro guardado con exito');
         } catch (\Exception $e)
         {             
           Log::error(UsuarioRepositories::class, $e->getMessage());
         }
        return $rh;
    }
 
    public function obtener($id):?Usuario
    {
        $dato = null;
        try
        {
            $dato = $this->usuario->find($id);                     
        }
        catch(\Exception $e)
        {
            Log::error(UsuarioRepositories::class, $e->getMessage(). "Linea: " . $e->getLine());
        }
        return $dato;
    }

    public function buscarEmail($email):ResponseHelper
    {
        $rh = new ResponseHelper();
        try
         {
             $tmp = $this->usuario->where('correo', $email)->first();
             if(is_object($tmp))
             {
                $rh->setResponse(true);
                $rh->result = $tmp;
             }
             else
             {
                $rh->setResponse(false, 'No existen registros que cumplan con la condicion ingresada');
             }
            
             $rh->setResponse(true, 'Registro guardado con exito');
         } catch (\Exception $e)
         {             
           Log::error(UsuarioRepositories::class, $e->getMessage(). "Linea: " . $e->getLine());
         }
        return $rh;
    }

    /*
    Autor: Ibrahim Alexis Lopez Roman,
    Descripcion: Funcion para autentificar a un usuario
    Fecha: Wednesday, October, 2018
    Hora: 08:08:57
    */
    public function autentificar(string $correo, string $password):ResponseHelper
    {
        $rh = new ResponseHelper();
        try
        {
            $datos = $this->usuario->where('correo', strtolower($correo))->where('password', sha1($password))->first();
            if (is_object($datos)) {
                Auth::signIn([
                    'id'=> $datos->id,
                    'nombre'=> $datos->nombre,
                    'rol_id'=> $datos->rol_id
                ]);
                $rh->setResponse(true);
            }
            else
            {
                $rh->setResponse(false, 'Usuario o Contraseña incorrectos');
                Log::critical(UsuarioRepositories::class, 'Intento Fallido de autentificacion para '.$correo);
            }
        }
        catch(\Exception $e)
        {
            Log::error(UsuarioRepositories::class, $e->getMessage(). "Linea: " . $e->getLine());
        }
        return $rh;
    }
    


}