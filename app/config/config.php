<?php

return [
    'db' => [        
        'host' => 'localhost',
        'paths' => [
            'main' => 'testMain',
            'second' => 'testSecond',
        ],
        'dbname' => 'test_db',
        'user' => 'postgres',
        'pass' => 'denys'
    ],
    'site' => [
        'debug' => 0,
        'pathErrorLog' => APP_DIR . '/errors/php_errors.log',
        'logErrors' => 'On',
        'paths' => [
            'main' => [
                'test1' => 'testMain'
            ],
            'second' => 'testSecond'
        ],
    ],
    'dirs' => [
        'views' => APP_DIR . '/app/views/'
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

