<?php 

class DatabaseConnection 
{

	public $dsn_prefix = "mysql:";
	public $host = "localhost";
	public $database_name = "pdo"; 
	public $username = "root"; 
	public $password = "root"; 
	public $dsn = $dsn_prefix . 'host=' . $host . ';' . 'dbname=' . $database_name; 
	public $active_connection; 


	public function Connect_to_databse() 
	{
	
		try {

			$active_connection = new PDO($dsn, $username, $password, $options); 
			echo 'connected to ' . $database_name; '<br />'; 

		}

		catch (PDOexception $e)
		{
			
			die('Error in connecting - ' .$e->getMessage() . '<br />'); 

		}
	
	}

	public function disconnect() 
	{
		$active_connection = null; 
	}

	public function get_query($query) 
	{
		//$result = $active_connection->query($query)
		//echo $result; 
		//return $result; 
	}

	public function get_all_rows_from_table($table) 
	{
		  
	}

}


?> 


