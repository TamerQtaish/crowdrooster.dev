<!doctype html>
<html>
<head>
	<title>Edit User</title>
</head>
<body>

	{{ Form::open(array('url' => 'user/edit_user/'.$user->id, 'method' => 'post')) }}
	
		@if($user->id == 0)
			<h1>New user profile</h1>
		@else
			<h1>Edit user profile: {{ $user->getFullName() }}.</h1>
		@endif

		@if($errors->has())
		   @foreach ($errors->all() as $error)
			  <p class="alert"><strong>{{ $error }}</strong></p>
		  @endforeach
		@endif

		<!-- hidden values -->
		{{ Form::token() }}
		{{ Form::hidden('id', $user->id) }}
		<p>
			{{ Form::label('email', 'Email Address') }}*
			{{ Form::text('email', $user->email) }}
		</p>
		
		<p>
			{{ Form::label('first_name', 'Forename') }}*
			{{ Form::text('first_name', $user->first_name) }}
		</p>		
		
		<p>
			{{ Form::label('last_name', 'Surname') }}*
			{{ Form::text('last_name', $user->last_name) }}
		</p>	

		<p>
			{{ Form::label('phone', 'Phone Number') }}
			{{ Form::text('phone', $user->phone) }}
		</p>			

		<p>
			{{ Form::label('password', 'New Password') }}*
			{{ Form::password('password') }} (Minimum 6 characters)
		</p>
		
		<p>
			{{ Form::label('password_confirmation', 'New Password (Verification)') }}*
			{{ Form::password('password_confirmation') }}
		</p>		
		<p>Leave blank if you do not want to change your password.</p>

		<p>{{ Form::submit('Save') }}</p>
	{{ Form::close() }}

</body>
</html>