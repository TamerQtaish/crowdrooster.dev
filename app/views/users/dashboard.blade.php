<!doctype html>
<html>
<head>
	<title>User Dashboard</title>
</head>
<body>

	<pre>
	{{-- print_r($user) --}}
	</pre>
	
	<h1>User dashboard for {{ $user->getFullName() }}.</h1>
	
	@if(Session::has('error_message'))
	<p class="alert"><strong>{{ Session::get('error_message') }}</strong></p>
	@endif	
	
	@if(Session::has('standard_message'))
	<p class="message"><strong>{{ Session::get('standard_message') }}</strong></p>
	@endif		

	<p>Last activity: {{ $user->updated_at }}</p>
	<p>Created: {{ $user->created_at }}</p>
	<p>Email: {{ $user->email }}</p>
	
	{{-- admin access only --}}
	@if($user->user_type == 2)
	<p><a href="{{ URL::to('user/view_all_users') }}">Show All Users</a></p>
	@endif
	
	<p><a href="{{ URL::to('user/edit_user/'.$user->id) }}">Edit User</a></p>
	<p><a href="{{ URL::to('user/logout') }}">Logout</a></p>

</body>
</html>