<!doctype html>
<html>
<head>
	<title>Look at me Login</title>
</head>
<body>

	{{ Form::open(array('url' => 'edit_user/'.$user->id, 'method' => 'post')) }}
		<h1>Edit profile: {{ $user->getFullName() }}.</h1>

		<!-- if there are form validation errors, show them here -->
		<p>
			{{ $errors->first('email') }}
			{{ $errors->first('password') }}
		</p>
		<!-- hidden values -->
		{{ Form::token() }}
		{{ Form::hidden('id', $user->id) }}
		<p>
			{{ Form::label('email', 'Email Address') }}
			{{ Form::text('email', $user->email) }}
		</p>
		
		<p>
			{{ Form::label('first_name', 'Forename') }}
			{{ Form::text('first_name', $user->first_name) }}
		</p>		
		
		<p>
			{{ Form::label('last_name', 'Surname') }}
			{{ Form::text('last_name', $user->last_name) }}
		</p>	

		<p>
			{{ Form::label('phone', 'Phone Number') }}
			{{ Form::text('phone', $user->phone) }}
		</p>			

		<p>
			{{ Form::label('password_1', 'New Password') }}
			{{ Form::password('password_1') }}
		</p>
		
		<p>
			{{ Form::label('password_2', 'New Password (Verification)') }}
			{{ Form::password('password_2') }}
		</p>		
		<p>Leave blank if you do not want to change your password.</p>

		<p>{{ Form::submit('Submit!') }}</p>
	{{ Form::close() }}

</body>
</html>