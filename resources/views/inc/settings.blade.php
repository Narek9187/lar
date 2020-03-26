@auth
	{{-- back button --}}
	<a href="{{url('user')}}" class="h1 container">back</a>

	{{-- Profile Change Form --}}
	<form action="{{url('/user/settings')}}" method="post" class="profile d-flex flex-column">
		@csrf
		<div>
			<label>Name:</label>
			<input value="{{Auth::user()->name}}" name="name">
		</div>
		<div>
			<label>Login:</label>
			<input value="{{Auth::user()->login}}" name="login">
		</div>
		<div>
			<label>Age:</label>
			<input value="{{Auth::user()->age}}" name="age">
		</div>
		<div>
			<label>Email:</label>
			<input value="{{Auth::user()->email}}" name="email">
		</div>
		<button class="btn">Change Profile</button>
	</form>

	{{-- Password Change Form --}}
	<form action="{{url('/user/reset')}}" method="post" class="mt-4 password" >
		@csrf
		<input placeholder="current password" name="current">
		<input placeholder="New password" name="new">
		<input placeholder="Repeat password" name="repeat">
		<button class="btn">Change Password</button>
	</form>

	{{-- Errors --}}
	@if (session('good') || session('err') || count($errors))
		<div class="alert alert-danger mt-4">{{session('good')}} {{session('err')}} {{$errors}}</div>
	@endif


@endauth