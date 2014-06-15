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
	
	public function showLogin()
	{
		// show the form
		return View::make('users.login');
	}

	public function doLogin()
	{
		// validate the info, create rules for the inputs
		$rules = array(
			'email'    => 'required|email', 
			'password' => 'required|alphaNum|min:3' 
		);

		// run the validation rules on the inputs from the form
		$validator = Validator::make(Input::all(), $rules);

		// if the validator fails, redirect back to the form
		if ($validator->fails()) {
			return Redirect::to('user/login')
				->withErrors($validator) 
				->withInput(Input::except('password')); 
		} else {

			// create our user data for the authentication
			$userdata = array(
				'email' 	=> Input::get('email'),
				'password' 	=> Input::get('password')
			);

			// attempt to do the login
			if (Auth::attempt($userdata)) {

				// validation successful, go to secure dashboard
				return Redirect::to('user/dashboard');

			} else {	 	

				// validation not successful, send back to form	
				return Redirect::to('user/login');

			}

		}
	}	
	
	public function doLogout()
	{
		Auth::logout(); 
		return Redirect::to('user/login'); 
	}	
	
	public function showDashboard()
	{
		$user = Auth::user();
		return View::make('users.dashboard', array('user' => $user));
	}
	
	public function showEditUser($id)
	{
		//check if user exists
		$user = User::find($id);
		$authenticated = FALSE;
		
		if ($user)
		{		
			//if user is not admin, then check if they are editing their own details
			$current_user = Auth::user();
			
			//is user admin or is user editing their own details
			if ( $current_user->user_type == 2 || $user->id == $current_user->id )
			{
				$authenticated = TRUE;
			};
		
		};
		
		//can user save these changes?
		if ( $authenticated )
		{
			//show view and pass data	
			return View::make('users.edit_user', array('user' => $user));
		}
		else //user cannot make changes
		{
			Session::flash('error_message', 'User could not be found, or you cannot edit this user!'); 
			return Redirect::to('user/dashboard');
		};
		
	}
	
	public function showViewAllUsers()
	{
		//check if user is admin first
		
		$users = User::all();
        return View::make('users.show_all', array('users' => $users));	
	}
	
	public function doSaveUser($id)
	{
		$authenticated = FALSE;
		
		//creating a new user and user is admin?
		$current_user = Auth::user();
		if ( $id == 0 && $current_user->user_type == 2 )
		{
			//prepare to create new user
			$authenticated = TRUE;
			$user = new stdClass();
		}
		else //saving an existing user
		{
			//check if user exists
			$user = User::find($id);
			$authenticated = isset( $user );
		};
		
		if ( $authenticated )
		{
			
			//validate data
			$credentials = [
				'email'=>Input::get('email'),
				'first_name'=>Input::get('first_name'),
				'last_name'=>Input::get('last_name'),
				''=>Input::get('phone'),
				'password'=>Input::get('password'),
				'password_confirmation'=>Input::get('password_confirmation')
			];
			
			$rules = [
				'email' => 'required|email|max:60',
				'first_name'=> 'required|max:30',
				'last_name'=>'required|max:30',
				'phone'=>'max:30',
				'password'=>'alpha_num|min:6|max:60|confirmed',
				'password_confirmation'=>'alpha_num|min:6|max:60'
			];
			
			//!!! this is not working: it should check if the email already belongs to same user only !!!!
			//'email' => 'required|email|unique:users,email|max:60',
			
			$validator = Validator::make($credentials,$rules);
			if($validator->passes())
			{
				//save user in model
				$user->email = Input::get('email');
				$user->first_name = Input::get('first_name');
				$user->last_name = Input::get('last_name');
				$user->phone = Input::get('phone');
				
				//set new password, if entered
				if ( Input::get('password') )
				{
					$user->password = Hash::make( Input::get('password') );					
				};			
				
				//save or create user, depending upon it's a new/existing user
				if ($id == 0)
				{
					User::create(array($user));
				}
				else
				{
					$user->save();		
				};
				
				//redirect user back to dashboard
				Session::flash('standard_message', "User '".$user->getFullName()."' details were successfully saved!"); 
				return Redirect::to('user/dashboard');

			}
			else //validation failed
			{
				return Redirect::back()->withErrors($validator)->withInput();
			};		
					
		}
		else //cannot find user
		{
			Session::flash('error_message', 'User could not be found!');
			return Redirect::to('user/dashboard');
		};
		
	}
	
	public function showNewUser()
	{
		$user = Auth::user();
		
		//is user admin 
		if ( $user->user_type == 2 )
		{
			//show view and pass data	
			return View::make('users.edit_user', array('user' => $this->createBlankUser() ));
		}
		else //user has no access
		{
			Session::flash('error_message', 'You do not have privileges to create a new user.'); 
			return Redirect::to('user/dashboard');
		};
	}
	
	private function createBlankUser()
	{
		$user = new stdClass();
		$user->id = 0;
		$user->email = NULL;
		$user->first_name = NULL;
		$user->last_name = NULL;
		$user->phone = NULL;
		return $user;
	}
	
	//for testing purposes only
	private function debug($data)
	{
		echo '<pre>'.print_r($data).'</pre>';
	}
	

}
