<?php

use Illuminate\Support\Facades\View;

#region Region para asignar las rutas del sistema
$router->controller('home', 'App\\Controller\\HomeController');
$router->controller('usuarios', 'App\\Controller\\UsuariosController');
$router->controller('permisos', 'App\\Controller\\PermisosController');
#endregion
$router->get('/', function () {
    //REDIRECCIONAR A LA CARPETA PUBLICA
    echo "<script> console.log('Hola prrr');</script>";
    \App\Helpers\UrlHelper::redirect('home');
});
$router->get('/help', function () {
    return 'Desarrollado por: Casi Ing. Ibrahim Alexis Lopez Roman';
}, ['before' => 'auth']);

 
