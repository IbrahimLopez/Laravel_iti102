<?php
/*
Autor: Ibrahim Alexis Lopez Roman,
Fecha: Wednesday, October, 2018
Hora: 21:23:45
Materia: Desarrollo de aplicaciones,
Maestro: Noe Cazarez,
Descripcion: Modulo de permisos
*/
 
namespace App\Controller;

use Core\Controller;
use App\Models\Permiso;
use App\Helpers\UrlHelper;
use Core\ServicesContainer;
use App\Helpers\ResponseHelper;
use App\Validations\PermisoValidation;
use App\Repositories\PermisoRepositories;


class PermisosController extends Controller
{
   private $config;

   public function __construct()
   {
      parent::__construct();
      $this->config = ServicesContainer::getConfig();
   }


   #REGION funciones para el catalogo de permisos
        #region Region para funciones GET (vistas)
        /*
        Autor: Ibrahim Alexis Lopez Roman,
        Descripcion: Funcion para listar los permisos
        Fecha: Wednesday, October, 2018
        Hora: 20:29:01
        */
        public function getindex()
        {
            $obj = new PermisoRepositories();
            return $this->
            render(
                'permisos/index.twig',
                [
                    'company_name' => $this->config['company_name'],
                    'title' => 'Permisos',
                    'permisos' => $obj->listar()
                ]
            );
        }
        /*
        Autor: Ibrahim Alexis Lopez Roman,
        Descripcion: Funcion para mostrar vista de crear permisos
        Fecha: Wednesday, October, 2018
        Hora: 20:58:52
        */
       
        public function getcreate()
        {    
           return $this->render('permisos/create.twig', ['title' => 'Crear Permiso']);
        }       

        /*
        Autor: Ibrahim Alexis Lopez Roman,
        Descripcion: Funcion para mostrar vista de editar permisos
        Fecha: Wednesday, October, 2018
        Hora: 21:00:10
        */
        public function getedit($id)
        {
            if($id <=0)
                UrlHelper::redirect('permisos');
            $model = (new PermisoRepositories)->obtener($id);            
           return $this->render('permisos/edit.twig',['title'=> 'Actualizando...','model'=> $model]);
        }

        /*
        Autor: Ibrahim Alexis Lopez Roman,
        Descripcion: Funcion para mostrar vista de eliminar permisos
        Fecha: Wednesday, October, 2018
        Hora: 21:00:43
        */
        public function getdelete($id)
        {
            if($id <= 0)
                UrlHelper::redirect('permisos');
                
            return $this->render('permisos/delete.twig', ['title'=> 'Eliminar','model'=> (new PermisoRepositories())->obtener($id)]);
        }
        #endregion  

        #region Region de funciones POST

        #endregion  
        #region Region de funciones POST de Permisos

         /*
        Autor: Ibrahim Alexis Lopez Roman,
        Descripcion: Funcion para crear un permiso
        Fecha: Wednesday, October, 2018
        Hora: 22:45:36
        */
        public function postcreate()
        {
           PermisoValidation::validate($_POST);
           $model = new Permiso();
           $model->nombre = $_POST['nombre'];
           $permisoRepo = new PermisoRepositories();
           $rh = $permisoRepo->guardar($model);
           if ($rh->response)
                $rh->href = 'permisos';
            print_r(json_encode($rh));
        }

        /*
        Autor: Ibrahim Alexis Lopez Roman,
        Descripcion: Funcion para editar permiso
        Fecha: Wednesday, October, 2018
        Hora: 23:04:46
        */
        public function postedit()
        {
            PermisoValidation::validate($_POST);
            $model = (new PermisoRepositories)->obtener($_POST['id']);
            if(isset($_POST['nombre'])) $model->nombre = $_POST['nombre'];
            $rh = (new PermisoRepositories)->guardar($model);
            if ($rh->response) {
                $rh->href = 'permisos';
            }
            print_r(json_encode($rh));
        }

        /*
        Autor: Ibrahim Alexis Lopez Roman,
        Descripcion: Funcion para eliminar un permiso
        Fecha: Thursday, October, 2018
        Hora: 18:21:57
        */
        public function postdelete()
        {
            $model = (new PermisoRepositories())->obtener($_POST['id']);
            $model->delete();
            $rh = new ResponseHelper();
            $rh->setResponse(true, 'El Registro se ha eliminado');
            if ($rh->response)
                $rh->href='permisos';        
            //UrlHelper::redirect('usuarios');
            print_r(json_encode($rh));
            
        }
        #endregion         
    #ENDREGION

}