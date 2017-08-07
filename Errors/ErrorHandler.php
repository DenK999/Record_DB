<?php 

/**
* 
*/
class ErrorHandler
{

function test($type) 
{ 
    
    return "huiohuio"; 
} 

	public static function my_error_handler()
	{
		$last_error = error_get_last();	

		$type = $last_error[type];	
		$message = $last_error[message];
		$file = $last_error[file];
		$line = $last_error[line];		

		if ($last_error)
		{        
			if ($type==E_ERROR)
			{        
				include "error505.html";
			}

			if ($type==E_WARNING)
			{      	

				echo "<script>console.log('Warning: $message IN FILE: $file IN LINE: $line');</script>";
			}

			if ($type==E_NOTICE)
			{   	
				echo "<script>console.log('NOTICE: $message IN FILE: $file IN LINE: $line');</script>";	    	

			}
		}
	}	

	
}

?>