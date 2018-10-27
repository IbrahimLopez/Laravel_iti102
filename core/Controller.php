<?php
/**
 * Created by PhpStorm.
 * User: ibrah
 * Date: 19/09/2018
 * Time: 08:03 AM
 */

namespace Core;


use Core\ServicesContainer;

class Controller
{
    protected $provider;


    public function __construct()
    {
        $config = ServicesContainer::getConfig();
        $loader = new \Twig_Loader_Filesystem(_APP_PATH_.'Views/');
        $this->provider = new \Twig_Environment(
            $loader, array(
                'cache' => !$config['cache'] ? false : _CACHE_PATH_,
                'debug' => false
            )
        );
        $this->provider->addExtension(new \Twig_Extension_Debug());
        $this->addCustomFilter();
    }

    public function addCustomFilter()
    {
        $this->provider->addFilter(new \Twig_SimpleFilter('public',
            ['App\\Helpers\\UrlHelper', 'public']));
        $this->provider->addFilter(new \Twig_SimpleFilter('url',
            ['App\\Helpers\\UrlHelper', 'base']));
        /*Funciones para Twig*/
        $this->provider->addFunction(new \Twig_SimpleFunction('user',['Core\\Auth', 'getCurrentUser']));
        $this->provider->addFunction(new \Twig_SimpleFunction('isLogin',['Core\\Auth', 'isLoggedIn']));
        #region: Funciones para el manejo de los roles
            $this->provider->addFunction(new \Twig_SimpleFunction('isRoot',['App\\Middlewares\\RolMiddlewares', 'isRoot']));
            $this->provider->addFunction(new \Twig_SimpleFunction('isAdmin',['App\\Middlewares\\RolMiddlewares', 'isAdmin']));
            $this->provider->addFunction(new \Twig_SimpleFunction('isMaestro',['App\\Middlewares\\RolMiddlewares', 'isMaestro']));
            $this->provider->addFunction(new \Twig_SimpleFunction('isAlumno',['App\\Middlewares\\RolMiddlewares', 'isAlumno']));
            $this->provider->addFunction(new \Twig_SimpleFunction('tienesPermiso',['App\\Middlewares\\RolMiddlewares', 'tienesPermiso']));
        #endregion
    }

    /**
     * @return mixed
     */
    public function render(string $view, array $data = []): string
    {
        return $this->provider->render($view, $data);
    }

}