<?php
/*
Autor: Ibrahim Alexis Lopez Roman,
Fecha: Thursday, October, 2018
Hora: 09:36:47
Materia: Desarrollo de aplicaciones,
Maestro: Noe Cazarez,
Descripcion: Modulo de roles
*/
 
namespace App\Controller;

use App\Models\Rol;
use Core\Controller;
use App\Helpers\UrlHelper;
use Core\ServicesContainer;
use App\Helpers\ResponseHelper;
use App\Validations\RolValidation;
use App\Repositories\RolRepositories;

class RolesController extends Controller
{
   private $config;

   public function __construct()
   {
      parent::__construct();
      $this->config = ServicesContainer::getConfig();
   }

   #region Region de metodos GET
   /*
   Autor: Ibrahim Alexis Lopez Roman,
   Descripcion: Funcion para mostrar los roles
   Fecha: Thursday, October, 2018
   Hora: 09:37:19
   */
   public function getindex()
   {
      return $this->render('roles/index.twig', ['roles'=> (new RolRepositories)->listar()]);
   }

   /*
   Autor: Ibrahim Alexis Lopez Roman,
   Descripcion: Funcion para mostrar vista de crear un rol
   Fecha: Thursday, October, 2018
   Hora: 19:02:04
   */
   public function getcreate()
   {
      return $this->render('roles/create.twig');
   }

   /*
   Autor: Ibrahim Alexis Lopez Roman,
   Descripcion: Funcion para mostrar la vista de editar roles
   Fecha: Thursday, October, 2018
   Hora: 19:06:14
   */
   public function getedit($id)
   {
      if($id <=0)
        UrlHelper::redirect('roles');
      
      return $this->render('roles/edit.twig', ['model'=> (new RolRepositories)->obtener($id)]);
   }   
   
   /*
   Autor: Ibrahim Alexis Lopez Roman,
   Descripcion: FUncion para mostrar la vista de eliminar roles
   Fecha: Thursday, October, 2018
   Hora: 19:17:37
   */
   public function getdelete($id)
   {
      return $this->render('roles/delete.twig', ['model'=>(new RolRepositories)->obtener($id)]);
   }

   #endregion 

   #region Region para funciones de tipo POST
   /*
   Autor: Ibrahim Alexis Lopez Roman,
   Descripcion: Funcion para crear un rol
   Fecha: Thursday, October, 2018
   Hora: 19:25:07
   */
   public function postcreate()
   {
      RolValidation::validate($_POST);
      $model = new Rol();
      $model->nombre = $_POST['nombre'];
      $rolRepo = new RolRepositories();
      $rh = $rolRepo->guardar($model);
      if($rh->response)
        $rh->href = 'roles';
      print_r(json_encode($rh));
   }

   /*
   Autor: Ibrahim Alexis Lopez Roman,
   Descripcion: Funcion para editar un rol
   Fecha: Thursday, October, 2018
   Hora: 19:35:10
   */
   public function postedit()
   {      
      RolValidation::validate($_POST);
      $model = (new RolRepositories)->obtener($_POST['id']); 
      if(isset($_POST['nombre'])) $model->nombre = $_POST['nombre'];     
      $rh = (new RolRepositories)->guardar($model);
      if ($rh->response)
          $rh->href = 'roles';      
      print_r(json_encode($rh));
   }

   /*
   Autor: Ibrahim Alexis Lopez Roman,
   Descripcion: Funcion para eliminar un rol
   Fecha: Thursday, October, 2018
   Hora: 19:38:43
   */
   public function postdelete()
   {
      $model = (new RolRepositories())->obtener($_POST['id']);
      $model->delete();
      $rh = new ResponseHelper();
      $rh->setResponse(true, 'El Registro se ha eliminado');
      if ($rh->response)
          $rh->href='roles';        
      print_r(json_encode($rh));
   }

   #endregion
}