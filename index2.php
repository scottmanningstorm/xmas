<?php 

ob_start();

require_once('Autoload/AutoLoader.php'); 

Autoloader::Autoload(); 

Application::env('local');


include('app/routes.php');

Route::matchRoute(); 


?> 