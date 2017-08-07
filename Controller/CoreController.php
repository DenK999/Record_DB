<?php

include "TimeController.php";
include "./Libraries/Printed.php";

/**
* 
*/
class CoreController
{
	/**
	 * [$step]
	 * @var integer
	 */
	private $step = 4;

	/**
	 * [$url first step]
	 * @var string
	 */
	private $url = "http://localhost/test/View/main.php?step=0";


	/**
	 * function for one cUrl
	 */
	function oneCurlRun()
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_exec($ch);
		curl_close($ch);
	}


	/**
	 * function for multi cUrl
	 */
	function MultiRun()
	{	
		$time = $time = new Time();
		$print = new Printed();

		
		$time_start_main = $time->timePoint();


		$mh = curl_multi_init();
		$i = 1;		
		
		while ($i <= $this->step) 
		{    		
    		$ch[$i] = curl_init();

    		// set URL and other appropriate options 
    		curl_setopt($ch[$i], CURLOPT_URL, "http://localhost/test/View/main.php?step=$i"); 
			curl_setopt($ch[$i], CURLOPT_HEADER, 0); 
			curl_multi_add_handle($mh,$ch[$i]);	
			$i++; 		
		}
		
		$running=null; 

		//execute the handles 
		do { 
			curl_multi_exec($mh,$running); 
		} while ($running > 0); 

		
		curl_multi_close($mh); 


		$time_end_main = $time->timePoint();
		$time_main = $time->formatTime($time_end_main - $time_start_main, 3);

		$print->printTime("Main ", $time_main);		
	}
}

?>
