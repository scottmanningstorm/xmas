<?php 

// Home routes
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

// routes for our game
Route::get('/xmas/play', 'gameController@play');
Route::get('/xmas/games', 'gameController@play'); 


Route::matchRoute(); 

?>