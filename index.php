<?php 
	
error_reporting(E_ALL);   	     
ini_set('display_errors', 1);    

ob_start();

require_once('framework/Autoload/AutoLoader.php'); 

Autoloader::Autoload(); 

Application::env('local');

include('app/routes.php');
 
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

// routes for our game
Route::get('/xmas/play', 'gameController@play');
Route::get('/xmas/games', 'gameController@play'); 


Route::matchRoute(); 


?> 

<html> 
<head>
	<style>
   		 body, html { margin:0; padding: 0; overflow:hidden; font-family:Arial; font-size:20px }
   		 #cr-stage { border:2px solid black; margin:5px auto; color:white }
    </style>
	<script type="text/javascript" src="http://craftyjs.com/release/0.4.2/crafty-min.js"></script>
	<script type="text/javascript" src="game.js"></script>
</head>
	<body>
	<h1> Crafty</h1>
	<script>
	
	
	</script>
	</body>
</html>