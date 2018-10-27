<?php
/*
Autor: Ibrahim Alexis Lopez Roman,
Fecha: Tuesday, October, 2018
Hora: 07:51:58
Materia: Desarrollo de aplicaciones,
Maestro: Noe Cazarez,
Descripcion: Controlador de autenticacion
*/
 
namespace App\Controller;

use Core\Auth;
use Core\Controller;
use App\Helpers\UrlHelper;
use Core\ServicesContainer;
use App\Repositories\UsuarioRepositories;

class AuthController extends Controller
{
   private $config;
   private $usuarioRepo;

   public function __construct()
   {
      if (Auth::isLoggedIn()) {
          UrlHelper::redirect();
      }
      parent::__construct();
      $this->config = ServicesContainer::getConfig();
      $this->usuarioRepo = new UsuarioRepositories();
   }


   /*
   Autor: Ibrahim Alexis Lopez Roman,
   Descripcion: vista del login
   Fecha: Tuesday, October, 2018
   Hora: 07:57:53
   */
   public function getindex()
   {
       $nrand = rand(1,5);
      return $this->render('auth/index.twig', ['title' => 'Autentificacion', 'fondo' => $nrand, 'company_name' => $this->config['company_name']]);
   }


   /*
   Autor: Ibrahim Alexis Lopez Roman,
   Descripcion: Verifica los datos ingresados por el usuario
   Fecha: Wednesday, October, 2018
   Hora: 08:07:56
   */
   public function postsignin()
   {
    $rh = $this->usuarioRepo->autentificar(
        $_POST['correo'],
        $_POST['password']
    );
    if ($rh->response) {
        $rh->href ="home";
    }
    print_r(json_encode($rh));
   }

 /*
 Autor: Ibrahim Alexis Lopez Roman,
 Descripcion: Funcion encargada de destruir la sesion
 Fecha: Wednesday, October, 2018
 Hora: 08:32:33
 */
 public function getsignout()
 {
    
    Auth::destroy();
    UrlHelper::redirect('');
 }


}

