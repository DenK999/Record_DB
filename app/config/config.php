<?php

return (object) array(
    'db' => (object) array(
        'host'   => 'localhost',
        'dbname' => 'test_db',
        'user'   => 'postgres',
        'pass'   => 'denys'
    ),
    'site' => (object) array(
        'debug'           => 'false',
        'pathErrorLog'    => $_SERVER['DOCUMENT_ROOT'].'/errors/php_errors.log',
        'logErrors'       => 'On'
        
    ),
    'file' => (object) array(
        'fileName'  => 'file',
        'pathTmp'   => '/tmp/',
        'csvExtent' => '.csv',
        'phpExtent' => '.php'
    )
    
);
