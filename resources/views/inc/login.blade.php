@if(session('good'))
	<script>
		let good = "{{session('good')}}";
		alert(good);
	</script>
@endif
<form class="container border w-25" action="{{url('login_send')}}" method="post">
	{{csrf_field()}}
	<div id="stext">Sign in</div>
	<div id="ltext">Login to sign in your account</div>
	<input name="email" id="log" placeholder="email">
	<input name="password" type="password" id="pass" placeholder="Password">
	<label class="lab p-0 pl-2 mt-2 mb-0" value="{{old('email')}}">{{$errors->first('email')}}</label>
	<label class="lab p-0 pl-2 mt-2 mb-0">{{$errors->first('password')}}</label>
	<button>Login</button>
	
	<div id="dont">Don't have an account? <a href="{{url('register')}}">Sign Up</a></div>
	<a href="{{url('forgot')}}">Forgot password ?</a>
</form>