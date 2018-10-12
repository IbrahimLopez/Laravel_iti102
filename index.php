<?php
    function exception_error_handler($severidad, $message, $archivo, $linea)
    {
        if (!(error_reporting() && $severidad))
            return;
        throw new ErrorException($message, 0, $severidad, $linea);
    }

    set_error_handler('exception_error_handler');

    //Composer psr-4
    require_once 'vendor/autoload.php';

    //Asignar la configuracion (Archivo config.php)
    \Core\ServicesContainer::setConfig(
        require_once 'config.php'
    );

    //Inicializar el DbContext
    \Core\ServicesContainer::initializeDbContext();

    $config = \Core\ServicesContainer::getConfig();

    //Establecer zona horaria
    date_default_timezone_set($config['timezone']);
    //Definimos la memoria
    ini_set('memory_limit', '-1');

    //URL base
    $base_url = '';
    $base_folder = strtolower(str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']));

    if (isset($_SERVER['HTTP_HOST'])) {
        $base_url = isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) != 'off' ? 'https' : 'http';
        $base_url .= '://' . $_SERVER['HTTP_HOST'];
        $base_url .= $base_folder;
    }

    define('_BASE_HTTP_', $base_url);
    define('_BASE_PATH_', __DIR__ . '/');
    define('_LOG_PATH_', __DIR__ . '/log/');
    define('_CACHE_PATH_', __DIR__.'/cache/');
    define('_APP_PATH_', __DIR__ . '/app/');
    define('_CURRENT_URI_', str_replace($base_folder, '', $_SERVER['REQUEST_URI']));

    if ($config['environment'] == 'stop')
        exit('SISTEMA TEMPORALMENTE FUERA DE LINEA...');

    if ($config['environment'] == 'dev')
        error_reporting(0);

    //FIN DE LA CONFIGURACION

    //Enrutamiento
    $router = new \Phroute\Phroute\RouteCollector();
    include_once 'app/routes.php';
    $dispacher = new \Phroute\Phroute\Dispatcher($router->getData());

    $response = $dispacher->dispatch(
        $_SERVER['REQUEST_METHOD'],
        _CURRENT_URI_
    );

    echo $response;


//\Core\Log::info('INDEX',"Hola Mundo papus");
