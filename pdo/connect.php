<?php 

class Connect 
{

	private $dsn_prefix = "mysql:";
	private $host = "localhost";
	private $database_name = "pdo"; 
	private $username = "root"; 
	private $password = "root"; 
	public  $dsn = ""; 
	private $options = array(
    	PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    ); 
    public $active_connection; 

	public function __construct() 
	{
	
		$this->dsn = $this->dsn_prefix . 'host=' . $this->host . ';' . 'dbname=' . $this->database_name; 
		
	}


	public function connect_to_database($username, $password, $database_name) 
	{

		if(isset($username)) 
			$this->username = $username; 
		if(isset($password))
			$this->password = $password; 
		if(isset($database_name))
			$this->database_name = database_name; 


		try {

			$this->active_connection = new PDO($this->dsn, $this->username, $this->password, $this->options); 
			echo 'Connected to ' . $this->database_name .'.....<br /><br />'; 
		   

		}	

		catch (PDOexception $e) {
			
			echo 'Error in connecting - ' .$e->getMessage() . '<br />';
			die(); 

		}

	}

	public function disconnect() 
	{
		$this->active_connection = null; 
		echo "<br /> Disconnected from " . $this->database_name . "<br />";
	}

	public function print_query($query) 
	{
	
		$results = $this->active_connection->query('SELECT * FROM test');
		
		?> 
        <table> 
        <?php 
		foreach ($results as $row) {
        	
        ?>
        	 <tr> 
        	 	<td> <?php print $row['ID']; ?> </td> 
        	 	<td> <?php print $row['Name']; ?> </td> 
        	 </tr>
        	<?php
      
    	}

    	?> </table> <?php

	}

	public function Get_assoc_array($query)
	{
		//If you query passed through grab all of databse. 
		if(!isset($query))
			$query = "SELECT * FROM test"; 

		$results = $this->active_connection->query($query);

		return $results; 
	} 


	public function Dump_databse() 
	{
 
		//Set up binding to add dynamic table caling
		$results = $this->Get_assoc_array("SELECT * FROM test"); 
		
	}

	public function Print_assoc_array($array) 
	{

		$results = $this->Get_assoc_array($array);
		?> <table> <?php

		foreach ($results as $row) {
        	
        ?>
        	 <tr> 
        	 	<td> <?php print $row['ID']; ?> </td> 
        	 	<td> <?php print $row['Name']; ?> </td> 
        	 </tr>
        <?php
      
    	}

    	?> </table> <?php

	}

	public function Edit_databse($queryFilter = "SELECT * FROM test") 
	{

		if(isset($queryFilter))
			$query = $queryFilter; 
		
		$query = $this->Get_assoc_array(); 

		?> <table> <?php

		foreach ($query as $row) {
        	
        ?>
        	 <tr> 
        	 	<td> <?php print $row['ID']; ?> </a> </td> 
        	 	<td> <?php print $row['Name']; ?> </td>
        	 	<td> <a href="http://<?php echo $_SERVER["SERVER_NAME"] .":". $_SERVER["SERVER_PORT"] . "?id=" . $row['ID'] ?>"> Edit Record </a> </td>  
        	 </tr>
        <?php
      
    	}

    	?> </table> <?php


	}


	public function Add_to_test_table($test, $id, $name) 
	{
		$query = "INSERT INTO test (test, ID, Name) Values(':test', ':ID', ':Name') ";
		$q = $this->active_connection->prepare($query); 
		$q->bindParam(':test', $test, PDO::PARAM_STR);
		$q->bindParam(':ID', $id, PDO::PARAM_STR);
		$q->bindParam(':Name', $name, PDO::PARAM_STR); 
		$q->execute(); 

		
	}


	public function delete_from_database($id) 
	{
		$query = "DELETE from test WHERE id = :id "; 
		$q = $this->active_connection->prepare($query); 
		$q->bindParam(':id', $id, PDO::PARAM_INT);
		$q->execute(); 
	}

	public function update_database() 
	{

	}



}



?>



<?php
/*
$query = new Query('table');

$data = $query->where('asd')->get();
*/

?>


 