<!doctype html>
<html>
<head>
	<title>Secure section</title>
</head>
<body>
	<pre>
	{{-- print_r($user) --}}
	</pre>
	<h1>User dashboard for {{ $user->getFullName() }}.</h1>
	<p>Last activity: {{ $user->updated_at }}</p>
	<p>Created: {{ $user->created_at }}</p>
	<p>Email: {{ $user->email }}</p>
	
	<p><a href="{{ URL::to('edit_user') }}">Edit User</a></p>
	<p><a href="{{ URL::to('logout') }}">Logout</a></p>

</body>
</html>