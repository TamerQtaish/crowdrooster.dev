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
//Route::any('user/create', 'UserController@create');

// route to show user authentication
Route::get('user/login', array('uses' => 'HomeController@showLogin'));
Route::post('user/login', array('uses' => 'HomeController@doLogin'));
Route::post('user/logout', array('uses' => 'HomeController@doLogout'));
Route::get('user/logout', array('uses' => 'HomeController@doLogout'));

//restrict dashboard for authenticated users only
Route::group(array('before' => 'auth'), function()
{
  Route::any('user/dashboard', array('uses' => 'HomeController@showDashboard'));
  Route::get('user/edit_user/{id}', array('uses' => 'HomeController@showEditUser'));
  Route::post('user/edit_user/{id}', array('uses' => 'HomeController@doSaveUser'));

	//restrict these controllers for admin access only
	Route::group(array('before' => 'user_type'), function() 
	{
		Route::any('user/view_all_users', array('uses' => 'HomeController@showViewAllUsers'));
		Route::get('user/new_user', array('uses' => 'HomeController@showNewUser'));
		Route::post('user/new_user', array('uses' => 'HomeController@doSaveNewUser'));
		Route::get('user/delete_user/{id}', array('uses' => 'HomeController@doDeleteUser'));
		Route::get('user/restore_user/{id}', array('uses' => 'HomeController@doDeleteUser'));
	});  
  
});




