{{-- @extends('layouts.app') --}}

{{-- @section('title')
	listenBroadcast
@endsection --}}

<!DOCTYPE html>
<html lang="en">
<head>
	<title>listen</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<!-- Css, Bootstrap -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="/css/app.css">
	
	<!-- Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Sriracha&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Nunito:400,700,900&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	
</head>
<style>ul {height: 34vh; overflow-y: auto;}</style>

<body class="bg-light">
	@include('inc.header')

	<div class="container">
		<div id="app" class="row clearfix">
			<div class="offset-4 w-auto float-left">
				<li class="bg-info list-group-item active" @click.prevent="delSession">Messenger
					<small><small class="bg-success" style="padding: 0.01rem 0.38rem; border-radius: 50px; margin-left: 40%"></small></small>
					<span v-if="onCount > 0" class="font-weight-bold">@{{onCount}}</span>
					<span v-else class="font-weight-bold">0</span>
				</li>
				<div class="badge badge-pill badge-info">@{{typing}}</div>
				<ul class="list-group" v-chat-scroll>
					<message v-for="value,index in chat.message" 
					:key=value.index :color=chat.color[index] :user=chat.user[index] :time=chat.time[index]
					>@{{value}}</message>
				</ul>
				
				<input type="text" class="form-control" placeholder="type your message" v-model="message" @keyup.enter="send">
			</div>
			<div class="form-control float-right contacts" style="width: auto; height: 14.3em; overflow-y: auto;">
				@foreach(DB::select('select * from users where id != '.Auth::user()->id) as $user)
					<div class="h5 text-info">{{$user->login}}</div>
				@endforeach
			</div>
		</div>
	</div>
	<!-- js -->
	<script src="{{asset('/js/jquery-3.4.1.min.js')}}"></script>
	<script src="{{asset('/js/app.js')}}"></script>
	<script src="https://js.pusher.com/5.1/pusher.min.js"></script>
</body>