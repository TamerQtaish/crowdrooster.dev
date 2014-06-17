

	<h1>All active users</h1>
	<p><a href="{{ URL::to('user/dashboard') }}">Dashboard</a></p>
	<p><a href="{{ URL::to('user/new_user') }}">Create New User</a></p>
	
	@foreach($users as $user)
	<p>{{ $user->getFullName(TRUE) }} | {{ $user->email }} | {{ $user->getDeletedStateDesc() }} | 
	<a href="{{ URL::to('user/edit_user/'.$user->id) }}">Edit</a> | 
		
		{{-- show appropriate button depending upon deleted state --}}
		@if($user->soft_deleted)
			<a href="{{ URL::to('user/restore_user/'.$user->id) }}">Restore</a></p>
		@else
			<a href="{{ URL::to('user/delete_user/'.$user->id) }}">Delete</a></p>
		@endif	
	@endforeach
	