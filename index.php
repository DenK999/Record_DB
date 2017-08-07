<?php

include 'Controller/CoreController.php';
include 'Config.php';
include 'Errors/ErrorHandler.php';




$config = new Config();

ini_set('display_errors', $config::DEBUG);
ini_set('display_startup_errors', $config::DEBUG);
error_reporting(E_ALL);

$core = new CoreController();
$core->oneCurlRun();

register_shutdown_function(function(){
	ErrorHandler::my_error_handler();
});


$core->MultiRun();



?>
