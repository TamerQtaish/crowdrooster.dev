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
	
		$view = View::make('index', array(
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
		
		
		$view = View::make('index', array(
					'title' => Lang::get('home.test.title')
					))
			->nest('viewBody', 'home.test', array());
			
		return $view;
	}
	
	public function showLogin()
	{
		// show the form
		$view = View::make('index', array(
					'title' => Lang::get('home.test.title')
					))
			->nest('viewBody', 'users.login', array());	
			
		return $view;
		
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
		
		$view = View::make('index', array(
					'title' => Lang::get('home.test.title')
					))
			->nest('viewBody', 'users.dashboard', array('user' => $user));	
			
		return $view;		
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
		
		//can current user edit this user?
		if ( $authenticated )
		{
			//show view and pass data				
			$view = View::make('index', array(
						'title' => Lang::get('home.test.title')
						))
				->nest('viewBody', 'users.edit_user', array('user' => $user ));	

				
			return $view;			
		}
		else //user cannot edit this user
		{
			Session::flash('error_message', 'User could not be found, or you do not have privileges to edit this user!'); 
			return Redirect::to('user/dashboard');
		};
		
	}
	
	public function showViewAllUsers()
	{
		//(routing should only allow admin users here)
		
		$users = User::orderBy('last_name')->get();

		$view = View::make('index', array(
					'title' => Lang::get('home.test.title')
					))
			->nest('viewBody', 'users.show_all', array('users' => $users));	
			
		return $view;				
	}
	
	//check if user passes validation before saving
	private function validateUser(&$user)
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
			
			//if this a new user, then make password entry obligatory
			if ( ! isset($user->id) )
			{
				$rules['password'] = 'required|alpha_num|min:6|max:60|confirmed';
				$rules['password_confirmation'] = 'required|alpha_num|min:6|max:60';
			};
			
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
				return NULL;
			}
			else //validation failed
			{
				return $validator;
			};			
	
	}
	
	public function doSaveUser($id)
	{
		//check if user exists
		$user = User::find($id);
		if ( isset( $user ) )
		{
			///validate user data
			$validator = $this->validateUser( $user );
			
			//were any validation errors returned?
			if ( $validator == NULL)
			{
				//no, save user data
				$user->save();		
				
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
	
	//soft delete user or un-delete user, depending upon current deleted state of user
	public function doDeleteUser($id)
	{
		//(routing should only allow admin users here, but leave checking code here in case rules change)
		
		$user = Auth::user();
		
		//is user admin 
		if ( $user->user_type == 2 )
		{
			//check if user exists
			$user = User::find($id);
			
			if ( isset( $user ) )
			{	
				//set deleted state to opposite of what it is
				$user->soft_deleted = ! $user->soft_deleted;
				$user->save();
				
				//redirect user back to dashboard
				if ( $user->soft_deleted )
				{
					Session::flash('standard_message', "User '".$user->getFullName()."' details was successfully soft deleted!"); 				
				}
				else
				{
					Session::flash('standard_message', "User '".$user->getFullName()."' details was successfully restored!"); 				
				};					
				return Redirect::to('user/dashboard');					
			}
			else //cannot find user
			{
				Session::flash('error_message', 'User could not be found!');
				return Redirect::to('user/dashboard');				
			};
		}
		else //user has no access
		{
			Session::flash('error_message', 'You do not have privileges to delete a user.'); 
			return Redirect::to('user/dashboard');
		};		
	}

	
	
	public function showNewUser()
	{
		//(routing should only allow admin users here, but leave checking code here in case rules change)
	
		$user = Auth::user();
		
		//is user admin 
		if ( $user->user_type == 2 )
		{
			//show view and pass data				
			$view = View::make('index', array(
						'title' => Lang::get('home.test.title')
						))
				->nest('viewBody', 'users.edit_user', array('user' => $this->createBlankUser() ));	
				
			return $view;				
		}
		else //user has no access
		{
			Session::flash('error_message', 'You do not have privileges to create a new user.'); 
			return Redirect::to('user/dashboard');
		};
	}
	
	public function doSaveNewUser()
	{
		//(routing should only allow admin users here, but leave checking code here in case rules change)
		
 		//only admin can create a new user
		$current_user = Auth::user();
		if ($current_user->user_type == 2 )
		{
			//create new user
			$user = new User;			
			
			///validate user data
			$validator = $this->validateUser( $user );
			
 			//were any validation errors returned?
			if ( $validator == NULL )
			{
				//save user data
				$user->save();		
				
				//redirect user back to dashboard
				Session::flash('standard_message', "New user '".$user->getFullName()."' details were successfully saved!"); 
				return Redirect::to('user/dashboard'); 		
			}
			else //validation failed
			{
				return Redirect::back()->withErrors($validator)->withInput();
			};	 
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
