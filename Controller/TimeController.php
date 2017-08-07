<?php 

/**
* 
*/
class Time
{
	/**
	 * [$valToPoint Rounds a float]
	 * @var integer
	 */
	private $valToPoint = 3;
	/**
	 * function to formating time value
	 * @param  float time
	 * @return [float]
	 */
	function formatTime(float $time)
	{
		return round($time, $this->valToPoint);
	}

	function timePoint()
	{
		return microtime(1);
	}
}

?>