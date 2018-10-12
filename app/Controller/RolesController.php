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

use Core\Controller;
use Core\ServicesContainer;

class RolesController extends Controller
{
   private $config;

   public function __construct()
   {
      parent::__construct();
      $this->config = ServicesContainer::getConfig();
   }

   /*
   Autor: Ibrahim Alexis Lopez Roman,
   Descripcion: Funcion para mostrar los roles
   Fecha: Thursday, October, 2018
   Hora: 09:37:19
   */
   public function getindex()
   {
      return $this->render('roles/index.twig');
   }
}