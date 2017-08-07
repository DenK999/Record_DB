<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include '../Config.php';
include '../Model/ModelDB.php';
include '../Controller/FileController.php';
include '../Controller/TimeController.php';
include '../Libraries/Printed.php';



$config = new Config();
$file = new FileController();
$model = new ModelDB();
$time = new Time();
$print = new Printed();

$step = intval($_GET["step"]);
$filepath = $config::PATH.$config::FILENAME.$step.$config::FILEEXTENTION;


$file->checkFile($filepath, $step);	

$time_start_main = $time->timePoint();


$file->saveRow($filepath, $step);
$model->copyToDB($filepath, $step);


$time_end_main = $time->timePoint();
$time_main = $time->formatTime($time_end_main - $time_start_main);

$print->printMainStepTime("Main time for", $step, $time_main);



?>
