
<span class="fh display-2 text-white">Registration</span>
<form action="{{url('/form_send')}}" method="post" class="d-flex flex-column container p-5">
	{{csrf_field()}}
	<!-- @csrf()  --> <!-- for ajax -->
	<input name="name" placeholder="name" class="inp form-control p-3 mt-2 mx-auto" value="{{old('name')}}">
	@if(count($errors))<label class="lab alert alert-light p-0 pl-2 m-0 w-100">{{$errors->first('name')}}</label>@endif
	
	<input name="login" placeholder="login" class="inp form-control p-3 mt-2 mx-auto" value="{{old('login')}}">
	@if(count($errors))<label class="lab alert alert-light p-0 pl-2 m-0 w-100">{{$errors->first('login')}}</label>@endif

	<input name="age" placeholder="age" class="inp form-control p-3 mt-2 mx-auto" value="{{old('age')}}">
	@if(count($errors))<label class="lab alert alert-light p-0 pl-2 m-0 w-100">{{$errors->first('age')}}</label>@endif

	<input name="email" placeholder="email" class="inp form-control p-3 mt-2 mx-auto" value="{{old('email')}}">
	@if(count($errors))<label class="lab alert alert-light p-0 pl-2 m-0 w-100">{{$errors->first('email')}}</label>@endif

	<input name="password" placeholder="password" class="inp form-control p-3 mt-2 mx-auto">
	@if(count($errors))<label class="lab alert alert-light p-0 pl-2 m-0 w-100">{{$errors->first('password')}}</label>@endif

	<input name="confirm" placeholder="confirm" class="inp form-control p-3 mt-2 mx-auto">
	@if(count($errors))<label class="lab alert alert-light p-0 pl-2 m-0 w-100 mb-3">{{$errors->first('confirm')}}</label>@endif

	<div class="custom-control custom-checkbox my-1 mr-sm-2">
		<input name="accept" type="checkbox" class="custom-control-input" id="customControlInline">
		<label class="custom-control-label p-0 pl-2 m-0 mb-2" for="customControlInline"></label>
		@if(count($errors))<label class=" alert alert-danger p-0 pl-2 m-0 mb-2">{{$errors->first('accept')}}</label>@endif
	</div>

	<button class="ml-auto">SIGN UP</button>
</form>
<div class="rotate-shadows"></div>