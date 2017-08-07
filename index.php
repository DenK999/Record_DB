<?php

include 'Controller/Corecontroller.php';
include 'Config.php';

$config = new Config();

ini_set('display_errors', $config::DEBUG);
ini_set('display_startup_errors', $config::DEBUG);
error_reporting(E_ALL);



$core = new CoreController();
$core->oneCurlRun();

try {
$core->MultiRun();
} catch (Exception $e) {
	echo '404';
}


?>
