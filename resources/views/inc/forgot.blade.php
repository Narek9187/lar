<div class="mt-5 h6">Please write email</div>
<form action="{{url('/forgot_send')}}" class="w-25">
	<input name="email" placeholder="email" class="form-control">
	<label class="p-0 pl-1 mt-2 mb-0 d-block text-danger">{{$errors->first('email')}}</label>
	<button class="btn btn-success mt-2">Submit</button>
</form>