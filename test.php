<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//variables to projekt

$dbhost = "localhost";
$dbuser = "postgres";
$dbpass = "denys";
$dbname = "test_db";
$path = '/var/www/html/ram/';
$filename ='file';
$step = intval($_GET["step"]);
$fileextention = '.csv';
$filepath = $path.$filename.$step.$fileextention;
$pgsql_conn_string = "pgsql:host=$dbhost;dbname=$dbname";


//connect to DB

try
{
	$dbConnection = new PDO($pgsql_conn_string, $dbuser, $dbpass);	


}
catch(PDOException $ex) 
{

	echo($ex->getMessage());
}


// function return random name or surname lenght = 15 symbols

function randomString()
{
	$start = 0 ;
	$length = 15;	
	return substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), $start, $length);

}


//function сheck for file and if the file is present clears it

function checkFile(string $filepath)
{
		
	if(file_exists($filepath))
	{
		$file = fopen($filepath , 'w');
		fclose($file);
	}	
	
	
}

//function return string with 1250000 records name,surname,age

function randomData()
{
	global $step;
	$stack = "";
	for ($i=0; $i <1250000; $i++) { 
		$id = $i + $step * 1250000;
		$name = randomString();
		$surmname = "wwwwwwwwwwwwwww";
		$age = mt_rand(1,99);		
		$stack .= "$id,$name,$surmname,$age" . "\n";

	}

	return $stack;
}

	checkFile($filepath);

	
//function TRUNCATE TABLE users in DB

function clearDB($dbConnection)
{
	$dbConnection->query("TRUNCATE TABLE users");
	die();
}	


	if ($step == 0) {
		clearDB($dbConnection);		
	}

//function write string with 1250000 records to csv file

function saveRow(string $filepath) 
{
	$file = fopen($filepath,"a");

	fwrite($file, randomData());
	
	fclose($file); 
}	

//function copy data from csv file to DB

function copyToDB($dbConnection, $filepath)
{
	$copySQL = "COPY public.users(id, name, surname, age) FROM '".$filepath."' WITH DELIMITER ','";
		
		try {
			$statement = $dbConnection->prepare($copySQL);
			$statement->execute();

		} catch (PDOException $e) {			
			echo $e->getMessage();			
		}

}

$time_start_main = microtime(1);

$time_start_add_file = microtime(1);

saveRow($filepath);

$time_end_add_file = microtime(1);

$time_start_add_bd = microtime(1);

copyToDB($dbConnection, $filepath);


$time_end_add_bd = microtime(1);


$time_add_file = round($time_end_add_file - $time_start_add_file, 3);
$time_add_bd = round($time_end_add_bd - $time_start_add_bd, 3);

$time_end_main = microtime(1);
$time_main = round($time_end_main - $time_start_main, 3);


echo "Main time for $step step is: <b>$time_main</b> sec<br><br>";
echo "Add Data to file time is: <b>$time_add_file</b> sec<br><br>";
echo "Add Data to BD time is: <b>$time_add_bd</b> sec<br><br><br>";
		

$dbConnection = null;

?>
