<?php

return [
    'db' => [
        'host' => 'localhost',
        'dbname' => 'test_db',
        'user' => 'postgres',
        'pass' => 'denys'
    ],
    'site' => [
        'debug' => 0,
        'pathErrorLog' => APP_DIR . '/errors/php_errors.log',
        'logErrors' => 'On',
        'defaultErroLog' => APP_DIR . '/errors/default_php_errors.log'
    ],
    'dirs' => [
        'views' => APP_DIR . '/app/views/',
    ],
    'file' => [
        'fileName' => 'file',
        'pathTmp' => '/tmp/',
        'csvExtent' => '.csv',
        'phpExtent' => '.php',
        'countFileRecord' => 5000
    ],
    'core' =>[
        'countCore' => 4
    ]
];

