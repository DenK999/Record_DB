<?php

/**
 * Controller to create, and write data to file
 */
class FileController
{
	/**
	 * [$stack description]
	 * @var string
	 */
	public $stack = "";

	/**
	 * [$age random age]
	 * @var integer
	 */
	public $age = 1;

	/**
	 * [$name random name]
	 * @var string
	 */
	public $name = "";

	/**
	 * [$surname random surname]
	 * @var string
	 */
	public $surname = "";

	/**
	 * [$alphabet alphabet for random string]
	 * @var string
	 */
	public $alphabet = "abcdefghijklmnopqrstuvwxyz";

	/**
	 * [$start start value to random string]
	 * @var integer
	 */
	public $start = 0;

	/**
	 * [$length lenght to random string]
	 * @var integer
	 */
	public $length = 15;

	/**
	 * [$countRecords countRecords for add to one file]
	 * @var integer
	 */
	public $countRecords = 12500;	


/**
 *  function return random string for write to file
 * 
 * @param  int count step
 * @return [string]
 */
function randomData(int $step)
{
	try {

		for ($i=0; $i <$this->countRecords; $i++) { 			
			$id = $i + $step * $this->countRecords;	
			$this->age = rand(1,99);
			$this->name = $this->randomString();
			$this->surname = $this->randomString();					
			$this->stack .= "$this->name,$this->surname,$this->age" . "\n";
		}
		
		
	} catch (Exception $e) {
		echo($e->getMessage());
	}

	return $this->stack;
}

/**
 * function write string with n records to file
 */
function saveRow(string $filepath, int $step) 
{	

	if($step != 0)
	{		
		$time = new Time();
		$print = new Printed();

		$time_start_add_file = $time->timePoint();	

		$file = fopen($filepath,"a");

		fwrite($file, $this->randomData($step));

		fclose($file); 

		$time_end_add_file = $time->timePoint();
		$time_add_file = $time->formatTime($time_end_add_file - $time_start_add_file);

		$print->printTime("Add Data to file ", $time_add_file);
	}	
}


/**
 * function return random name or surname lenght = 15 symbols
 * @return [string]
 */
function randomString()
{	
	return substr(str_shuffle($this->alphabet), $this->start, $this->length);
}



/**
 * function сheck for file and if the file is present clears it
 * 
 * @param  string path to file
  */
function checkFile(string $filepath, int $step)
{
	if(file_exists($filepath) && $step != 0)
	{				
		$file = fopen($filepath , 'w');
		fclose($file);
	}		
}

}

?>