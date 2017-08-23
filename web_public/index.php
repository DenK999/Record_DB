<?php

define('APP_DIR', dirname(dirname(__FILE__)));

require_once APP_DIR.'/library/Solveo/Config.php';
ini_set('display_errors', Solveo\Config::get()->site->debug);
ini_set('display_startup_errors', Solveo\Config::get()->site->debug);
ini_set('log_errors', Solveo\Config::get()->site->logErrors);
ini_set('error_log', Solveo\Config::get()->site->pathErrorLog);
error_reporting(E_ALL);

require_once APP_DIR.'/library/Solveo/Autoloader.php';
$autoload = new \Solveo\Autoloader();
$autoload->addNamespace('Solveo', APP_DIR.'/library/Solveo');
$autoload->addNamespace('Solveo\Model', APP_DIR.'/app/models');
$autoload->addNamespace('Solveo\Controller', APP_DIR.'/app/controllers');

Solveo\PHPErrorException::getInstance()->register();

Solveo\Route::start();  //start app





