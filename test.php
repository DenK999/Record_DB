<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$dbhost = "localhost";
$dbuser = "postgres";
$dbpass = "denys";
$dbname = "test_db";

$pgsql_conn_string = "pgsql:host=$dbhost;dbname=$dbname";

try
{
	$dbConnection = new PDO($pgsql_conn_string, $dbuser, $dbpass);
}
catch(PDOException $ex) 
{

	echo($ex->getMessage());
}

function randomString()
{
	$start = 1;
	$length = 15;	
    return substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), $start, $length);

}


function randomTest()
{
	$test = "";
	for ($i=0; $i <10000; $i++) { 
		$name = randomString();
		$surmname = randomString();
		$age = randomString();		
		$test .= "$name,$surmname,$age" . "\n";

	}

	return $test;
}



$time_start_randomString = microtime(1);

randomTest();


$time_end_randomString = microtime(1);
$time_randomString = round($time_end_randomString - $time_start_randomString, 7);





$fh = fopen( '../file.csv', 'w' );
fclose($fh);

$dbConnection->query("TRUNCATE TABLE users");

$time_start_main = microtime(1);

//$sql = "INSERT INTO users (name, surname, age) VALUES ('Cardinal','Tom', 3)";





function randomData()
{
	$stack = "";
	for ($i=0; $i <1000000; $i++) { 
		$name = randomString();
		$surmname = randomString();
		$age = rand(1,99);		
		$stack .= "$name,$surmname,$age" . "\n";

	}

	return $stack;
}


$time_start_add_file = microtime(1);

function saveRow($list) {
  $file = fopen("../file.csv","a");
  
    fwrite($file, print_r($list, TRUE));
  fclose($file); 
}
	

for ($i=0; $i < 1; $i++) { 
	saveRow(randomData());
}

$time_end_add_file = microtime(1);




/*function insertData($dbConnection,$sql)
{
	for ($i=0; $i <10000 ; $i++) { 
		$dbConnection->query($sql);    	
	}
}*/


$time_start_add_bd = microtime(1);


//$dbConnection->query("COPY users(name, surname, age) FROM '/var/www/html/file.csv' WITH DELIMITER ',' CSV");

$time_end_add_bd = microtime(1);
$time_end_main = microtime(1);


$time_add_file = round($time_end_add_file - $time_start_add_file, 3);
$time_add_bd = round($time_end_add_bd - $time_start_add_bd, 3);
$time_main = round($time_end_main - $time_start_main, 3);


echo "Random function time is: <b>$time_randomString</b> sec<br><br><br>";

echo "Add Data to file time is: <b>$time_add_file</b> sec<br><br>";
echo "Add Data to BD time is: <b>$time_add_bd</b> sec<br><br>";
echo "Main time is: <b>$time_main</b> sec";


?>