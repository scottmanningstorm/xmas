<?php 

$dsn_prefix = "mysql:";
$host = "localhost";
$database_name = "pdo"; 
$username = "root"; 
$password = "root"; 
$dsn = $dsn_prefix . 'host=' . $host . ';' . 'dbname=' . $database_name; 


$options = array(

    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',

); 


try {

	$dbh = new PDO($dsn, $username, $password, $options); 
	echo 'connected to ' . $database_name; '<br />'; 

}

catch (PDOexception $e)
{
	
	echo 'Error in connecting - ' .$e->getMessage() . '<br />';
	die(); 

}
