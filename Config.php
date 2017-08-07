<?php 

/**
 * configuration class
 */

class Config
{
	const DEBUG = 0;
	const LOGERRORS = 'On';	
	const ERRORLOG = '/var/www/html/test/Log/php_errors.log';
	const DBHOST = 'localhost';
	const DBUSER = 'postgres';
	const DBPASS = 'denys';
	const DBNAME = 'test_db';

	const PATH = '/var/www/html/test/Tmp/';
	CONST FILENAME ='file';
	const FILEEXTENTION = '.csv';	
}

?>