@extends('layouts.app')

<div class="mt-5 h6">Create New Password</div>
<form action="{{url('reset_password', $id)}}" class="w-25">
	<input name="password" placeholder="password" class="form-control">
	<input name="confirm" placeholder="Repeat Password" class="form-control">
	<label class="p-0 pl-1 mt-2 mb-0 d-block text-danger">{{$errors->first('password')}}</label>
	<label class="p-0 pl-1 mt-2 mb-0 d-block text-danger">{{$errors->first('confirm')}}</label>
	<button class="btn btn-success mt-2">Submit</button>
</form>
