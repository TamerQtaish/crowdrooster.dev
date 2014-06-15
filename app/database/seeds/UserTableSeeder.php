<?php

class UserTableSeeder extends Seeder
{
	public function run()
	{
		DB::table('users')->delete();
		
		User::create(array(
			'first_name' => 'John',
			'last_name' => 'Smith',
			'email'    => 'johnsmith@gmail.com',
			'user_type'    => '2',
			'password' => Hash::make('password'),
		));
		
		User::create(array(
			'first_name' => 'Shane',
			'last_name' => 'Mosley',
			'email'    => 'shanemosley@virgin.net',
			'password' => Hash::make('password'),
		));		
		
		User::create(array(
			'first_name' => 'Bernard',
			'last_name' => 'Hopkins',
			'email'    => 'bernardhopkins@yahoo.com',
			'password' => Hash::make('password'),
		));	

		User::create(array(
			'first_name' => 'Charlie',
			'last_name' => 'Zed',
			'email'    => 'goat_charlie_z@gmail.com',
			'password' => Hash::make('password'),
		));			
		
		User::create(array(
			'first_name' => 'James',
			'last_name' => 'Toney',
			'email'    => 'jamestoney@yahoo.com',
			'password' => Hash::make('password'),
		));		
	}

}