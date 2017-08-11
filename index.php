<?php

$config = include('./app/config/config.php');

ini_set('display_errors', $config->site->debug);
ini_set('display_startup_errors', $config->site->debug);
ini_set('log_errors', $config->site->logErrors);
ini_set('error_log', $config->site->pathErrorLog);

error_reporting(E_ALL);


require_once __DIR__.'/library/Solveo/Autoloader.php';

$autoload = new \Solveo\Autoloader();
$autoload->addNamespace('Solveo', __DIR__.'/library/Solveo');
$autoload->addNamespace('Solveo\Model', __DIR__.'/app/models');
$autoload->addNamespace('Solveo\Controller', __DIR__.'/app/controllers');
$autoload->addNamespace('Solveo\Library', __DIR__.'/app/library');
$autoload->register();

require_once 'web_public/bootstrap.php';
