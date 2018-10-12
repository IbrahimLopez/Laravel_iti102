<?php
return [
    'database' => [
        'driver'  => 'mysql',
        'host'  => '127.0.0.1',
        'database'  => 'plantilla',
        'username'  => 'root',
        'password'  => '',
        'charset'  => 'utf8',
        'collation'  =>'utf8_unicode_ci',
        'prefix'  => ''
    ],
    'session_time' => 10,
    'session_name' => 'application-auth',
    'secret-key' => '@1br4ch0l_0.bcspn',
    'environment' => 'dev', // dev, prod, stop
    'timezone'  => 'America/Hermosillo',
    'cache' => false,
    'company_name'  => 'TIC10-2'
];