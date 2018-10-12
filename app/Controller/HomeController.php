<?php
/*  Developed by: Ibrahim Alexis Lopez Roman
    Año: 19/09/2018,
    Materia: ,
    Maestro: ,
    Descripcion:
*/
namespace App\Controller;

use Core\Controller;
use Core\ServicesContainer;

class HomeController extends Controller
{
    private $config;

    public function __construct()
    {
        parent::__construct();
        $this->config = ServicesContainer::getConfig();
    }

    /*
        Autor: Ibrah,
        Descripcion: Funcion GET,
        Fecha: 19/09/2018
    */
    public function getindex()
    {
        return $this->render('home/index.twig',['title' => $this->config['company_name']]);
    }

    /*
        Autor: Ibrah,
        Descripcion: Quienes somos,
        Fecha: 21/09/2018
    */
    public function getabout()
    {
        return $this->render('home/about.twig',['title' => $this->config['company_name']]);
    }

    /*
        Autor: Ibrah,
        Descripcion: Metodo mostrar vista contact,
        Fecha: 24/09/2018
    */
    public function getcontact ()
    {
        return $this->render('home/contact.twig',['title' => $this->config['company_name']]);
    }

    /*
        Autor: Ibrah,
        Descripcion: Metodo mostrar vista de productos,
        Fecha: 25/09/2018
    */
    public function getproducts ()
    {
        return $this->render('home/products.twig',['title' => $this->config['company_name']]);
    }
}