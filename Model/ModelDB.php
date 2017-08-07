<?php 

/**
*  Class for work to DB
*/
class ModelDB
{	
	/**
	 * 
	 * @var [DBconnection]
	 */
	private $dbConnection;


	/**
	 *	function connect to DB
	 * 
	 * @return [DBconnection]
	 */
	function connectDB()
	{
		$config = new Config();
		$dbhost = $config::DBHOST;
		$dbname = $config::DBNAME;

		try
		{
			$this->dbConnection = new PDO("pgsql:host=$dbhost; dbname=$dbname", $config::DBUSER, $config::DBPASS);	


		}
		catch(PDOException $ex) 
		{

			echo($ex->getMessage());
		}
		return $this->dbConnection;

	}


	/**
	 * function TRUNCATE TABLE users in DB
	 */
	function clearDB()
	{		
		$this->connectDB()->query("TRUNCATE TABLE users");
		die();	
	}	

	/**
	 *function copy data from csv file to DB
	 * 
	 * @param  string
	 * @param  int 
	 */
	function copyToDB(string $filepath, int $step)
	{
		if($step != 0)
		{			
			$time = new Time();
			$print = new Printed();
			$time_start_add_bd = $time->timePoint();

			$copySQL = "COPY public.users(name, surname, age) FROM '".$filepath."' WITH DELIMITER ','";

			try {
				$statement = $this->connectDB()->prepare($copySQL);
				$statement->execute();

			} catch (PDOException $e) {			
				echo $e->getMessage();			
			}

			$time_end_add_bd = $time->timePoint();
			$time_add_bd = $time->formatTime($time_end_add_bd - $time_start_add_bd);

			$print->printTime("Add Data to BD ", $time_add_bd);		

		}
		else
		{
			$this->clearDB();

		}
	}


	
}

?>