<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function index()
	{
		return $view = View::make('index', array(
					'title' => Lang::get('home.index.title')
					))
			->nest('viewBody', 'home.index', array());
			
		return $view;
	}
	
	public function test()
	{
		
//		print_r(phpinfo());
//		die();
		
		$user = User::where('id', 1)->get();
		
		print_r($user);
		
		
		return $view = View::make('index', array(
					'title' => Lang::get('home.test.title')
					))
			->nest('viewBody', 'home.test', array());
			
		return $view;
	}
	
	
	

}
