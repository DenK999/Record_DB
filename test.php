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

function randText()
{
	$length = 15;
	$str = "";
	$characters = array_merge(range('A','Z'), range('a','z'));
	$max = count($characters) - 1;
	for ($i = 0; $i < $length; $i++) {
		$rand = mt_rand(0, $max);
		$str .= $characters[$rand];
	}
	return $str;

}

$fh = fopen( 'file.csv', 'w' );
fclose($fh);


$time_start = microtime(1);

//$sql = "INSERT INTO users (name, surname, age) VALUES ('Cardinal','Tom', 3)";


function randomData()
{
	$stack = array();
	for ($i=0; $i <100000; $i++) { 
		$name = randText();
		$surmname = randText();
		$age = rand(1,99);		
		array_push($stack, Array("$name,$surmname,$age"));

	}

	return $stack;
}


function saveRow($list) {
  $file = fopen("file.csv","a");
  foreach ($list as $line)
  {
    fputcsv($file,$line);
  }
  fclose($file); 
}
	

for ($i=0; $i < 10; $i++) { 
	saveRow(randomData());
}


$time_end = microtime(1);
$time = $time_end - $time_start;

echo "Time is: $time sec\n";


?>