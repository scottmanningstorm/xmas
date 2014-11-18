<?php 

	ini_set('display_errors', 'on');

	require('connect.php');
	 

	$db = new Connect(); 
	$db->connect_to_database();

	
	
	//$db->Print_assoc_array("SELECT * FROM test");
 	

 	//$db->Add_to_test_table("1", "2", "3"); 
 	//$db->delete_from_database(4); 


?>
