<!doctype html>
<html>
<head>
	<title>Secure section</title>
</head>
<body>

	<h1>All Users</h1>
	
	@foreach($users as $user)
	<p><a href="{{ URL::to('edit_user/'.$user->id) }}">{{ $user->getFullName() }}</a> | {{ $user->email }}</p>
	@endforeach
	
</body>
</html>