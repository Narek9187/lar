@guest
	<div class="head bg-light clearfix p-4 sticky-top shadow-lg" style="opacity: 0.8">
		<span class="float-left p-2 narek text-light">Narek</span>
		<a href="{{url('register')}}" class="float-right nav-link text-light">SignUp</a>
		<a href="{{url('login')}}" class="float-right nav-link text-light">SignIn</a>
		<a href="{{url('/')}}" class="float-right nav-link text-light">Home</a>
	</div>
@endguest

@auth
	<div class="head bg-light clearfix p-4 sticky-top shadow-lg" style="opacity: 0.8">
		<a href="{{url('logout')}}" class="float-right font-weight-bold nav-link text-light">Exit</a>
		<a href="{{url('listen')}}" class="float-right font-weight-bold nav-link text-light">Chat</a>
		<a href="{{url('/user/settings')}}" class="float-right nav-link text-light">Profile settings</a>
		<a href="{{url('user')}}" class="float-right nav-link text-light">Profile</a>
		<a href="{{url('/')}}" class="float-right nav-link text-light">Home</a>
	</div>

	<div class="d-flex welcome flex-wrap align-items-end justify-content-end mt-4 mb-2">
		<div class="h6 mr-2">
			<a href="{{route('wishlist')}}" class="far fa-star" title="wishlist"></a>
			<i class="bg-danger" id="c_count">{{DB::table("cart")->where('users_id', Auth::user()->id)->count('*')}}</i>
			<a href="{{route('cart')}}" class="fas fa-shopping-cart text-warning" title="cart"></a>
		</div>
		<div class="h6 mr-5 text-secondary font-weight-bold">{{Auth::user()->login}}</div>
	</div>
@endauth

<style>
	.welcome * {opacity: 0.6;}
	.welcome {position: sticky; top: 12vh; z-index: 2}
	.welcome div>#c_count {font-size: 0.8vw; padding: 0.1px 4px; border-radius: 25px; position: relative; left: 12%; top: 1vh; z-index: 0; font-weight: bold; opacity: 0.9; color: white}
	.fa-shopping-cart {z-index: 1; font-size: 2vw;}
	.fa-star {color: #7700b8; font-size: 2vw;}
	.fa-shopping-cart:hover, .fa-star:hover {text-decoration: none; color: #7700b8; opacity: 0.8}
	.head a, .narek {text-shadow: 0px 3px 0px #b2a98f; font-size: 1.4vw}
	.head:hover {padding-bottom: 14px 0px !important; padding-top: 14px !important;}
</style>