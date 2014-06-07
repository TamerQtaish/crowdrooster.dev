<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/**
* View Composers, to handle:
* - Header
* - News modal
* - Notifications
*/


Route::any('/', 'HomeController@index');
Route::any('test', 'HomeController@test');



