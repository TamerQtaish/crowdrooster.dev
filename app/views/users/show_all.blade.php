<!doctype html>
<html>
<head>
	<title>All Users</title>
</head>
<body>

	<h1>All Users</h1>
	<p><a href="{{ URL::to('user/new_user') }}">Create New User</a></p>
	
	@foreach($users as $user)
	<p>{{ $user->getFullName() }} | {{ $user->email }} | 
	<a href="{{ URL::to('user/edit_user/'.$user->id) }}">Edit</a> | 
	<a href="{{ URL::to('user/delete_user/'.$user->id) }}">Delete</a></p>
	@endforeach
	
</body>
</html>