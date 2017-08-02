<?php

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "http://localhost/ram/test.php?step=0");
curl_setopt($ch, CURLOPT_HEADER, 0);


curl_exec($ch);


curl_close($ch);

$time_start_main = microtime(1);
$ch1 = curl_init(); 
$ch2 = curl_init();
$ch3 = curl_init(); 
$ch4 = curl_init(); 

// set URL and other appropriate options 
curl_setopt($ch1, CURLOPT_URL, "http://localhost/ram/test.php?step=1"); 
curl_setopt($ch1, CURLOPT_HEADER, 0); 
curl_setopt($ch2, CURLOPT_URL, "http://localhost/ram/test.php?step=2"); 
curl_setopt($ch2, CURLOPT_HEADER, 0); 
curl_setopt($ch3, CURLOPT_URL, "http://localhost/ram/test.php?step=3"); 
curl_setopt($ch3, CURLOPT_HEADER, 0); 
curl_setopt($ch4, CURLOPT_URL, "http://localhost/ram/test.php?step=4"); 
curl_setopt($ch4, CURLOPT_HEADER, 0); 

//create the multiple cURL handle 
$mh = curl_multi_init(); 

//add the two handles 
curl_multi_add_handle($mh,$ch1); 
curl_multi_add_handle($mh,$ch2); 
curl_multi_add_handle($mh,$ch3); 
curl_multi_add_handle($mh,$ch4);

$running=null; 
//execute the handles 
do { 
    curl_multi_exec($mh,$running); 
} while ($running > 0); 

//close the handles 
curl_multi_remove_handle($ch1); 
curl_multi_remove_handle($ch2); 
curl_multi_remove_handle($ch3); 
curl_multi_remove_handle($ch4); 
curl_multi_close($mh); 


$time_end_main = microtime(1);
$time_main = round($time_end_main - $time_start_main, 3);
echo "Main time is: <b>$time_main</b> sec";

?>
