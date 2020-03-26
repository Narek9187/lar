<!DOCTYPE html>
<html lang="en">
<head>
	<title>@yield('title')</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<!-- Css, Bootstrap -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="/css/app.css">
	<!-- js -->
	<script src="{{asset('/js/jquery-3.4.1.min.js')}}"></script>
	<script src="{{asset('/js/app.js')}}"></script>
	<script src="https://js.pusher.com/5.1/pusher.min.js"></script>
	<script type="text/javascript" src="https://cdn.rawgit.com/igorlino/elevatezoom-plus/1.1.6/src/jquery.ez-plus.js"></script>
	{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> --}}
	{{-- <script src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script> --}}
	<!-- Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Sriracha&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Nunito:400,700,900&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	
</head>
<body class="bg-light">
	@include('inc.header')

	@yield('items')

	<!-- listen -->
	{{-- @if(Request::is('listen')) --}}
		{{-- @yield('regCss') --}}
	{{-- @endif --}}


	<!-- register -->
	@if(Request::is('register'))
		@include('inc.register')
		@yield('regCss')
	@endif
	

	<!-- login -->
	@if(Request::is('login'))
		@include('inc.login')
		@yield('logCss')
	@endif


	<!-- forgot password -->
	@if(Request::is('forgot'))
		@include('inc.forgot')
	@endif


	<!-- user account -->
	@if(Request::is('user'))
		@include('inc.user')
		@yield('userCss')
		@yield('jq')
		@yield('zoom')
	@endif

	<!-- user settings -->
	@if(Request::is('user/settings'))
		@include('inc.settings')
		@yield('settingsCss')
	@endif

	<!-- item detail -->
	@if(Request::is('user/*/detail'))
		@include('inc.detail')
		@yield('detJs')
	@endif

	<!-- wishlist -->
	@if(Request::is('user/wishlist'))
		@include('inc.wishlist')
		@yield('wishlistCss')
		@yield('wishlistJs')
	@endif

	<!-- cart -->
	@if(Request::is('user/cart'))
		@include('inc.cart')
		@yield('cartCss')
		@yield('cartJs')
	@endif

	<!-- stripe -->
	@if(Request::is('stripe'))
		@include('inc.stripe')
		@yield('stripeCss')
		@yield('stripeJs')
	@endif


</body>
</html>