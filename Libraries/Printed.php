<?php 

/**
 *  Class for printed time
 */
class Printed
{	
	function printTime(string $text, float $time)
	{
		echo "$text time is: <b>$time</b> sec<br><br>";
	}

	function printMainStepTime(string $text, int $step, float $time)
	{
		echo "$text $step step time is: <b>$time</b> sec<br><br><br>";
	}
}

?>