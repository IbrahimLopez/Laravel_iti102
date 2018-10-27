<?php

//use Illuminate\Support\Facades\View;

$router->group(['before' => 'auth'],function($router){
    $router->controller('usuarios', 'App\\Controller\\UsuariosController');
});
#region Region para asignar las rutas del sistema
$router->controller('home', 'App\\Controller\\HomeController');
//$router->controller('usuarios', 'App\\Controller\\UsuariosController');
$router->controller('permisos', 'App\\Controller\\PermisosController');
$router->controller('roles', 'App\\Controller\\RolesController');
$router->controller('auth', 'App\\Controller\\AuthController');
$router->controller('tienda', 'App\\Controller\\TiendaController');
#endregion
$router->get('/', function () {
    //REDIRECCIONAR A LA CARPETA PUBLICA
    if (Core\Auth::isLoggedIn()) {
        \App\Helpers\UrlHelper::redirect('home');

    }else{
        \App\Helpers\UrlHelper::redirect('auth');
    }
    
});
$router->get('/help', function () {
    return 'Desarrollado por: Casi Ing. Ibrahim Alexis Lopez Roman';
}, ['before' => 'auth']);

 
