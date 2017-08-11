<?php

return (object) array(
    'db' => (object) array(
        'host'   => 'localhost',
        'dbname' => 'test_db',
        'user'   => 'postgres',
        'pass'   => 'denys'
    ),
    'site' => (object) array(
        'debug'           => 'true',
        'path_error_log'  => $_SERVER['DOCUMENT_ROOT'].'/errors/php_errors.log'
        
    ),
    'file' => (object) array(
        'file_name'  => 'file',
        'path_tmp'   => '/tmp/',
        'csv_extent' => '.csv',
        'php_extent' => '.php'
    )
    
);
