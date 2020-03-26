@extends('layouts.app')

@section('title')
Home
@endsection

@section('items')

<div class="d-flex mt-5 flex-wrap align-items-end justify-content-between container">
	@foreach($items as $item)
		<div class="card mt-2" style="width:22%;">
			<div class="card-body pt-2">
				<img class="card-img-top p-1" src="{{asset('/images/'.$item->photo[0]->img)}}" data-zoom-image="{{asset('/images/'.$item->photo[0]->img)}}">
				<span data-id="{{$item->id}}" class="fas fa-shopping-basket text-warning cart" title="add to cart"></span>
				@auth
				@if(count(DB::table("wishlist")->get()) && DB::select("select * from wishlist where users_id = ".Auth::user()->id." and products_id = ".$item->id))
					<span data-id="{{$item->id}}" class="fas fa-heart text-danger like"></span>
				@else
					<span data-id="{{$item->id}}" class="far fa-heart text-danger unlike" title="add wishlist"></span>
				@endif
				@endauth
				<div class="card-title name font-weight-bold">{{$item->name}}</div>
				<span class="card-text mb-1">{{$item->price}}</span><span class="symbol">&#1423;</span><br>
				<span class="card-text mb-1" id="count">{{$item->count}}</span><span class="symbol">հատ</span><br>
				<span class="card-text mb-1">{{$item->description}}</span>
				<div class="card-title font-weight-bold text-dark mb-0 mt-3" id="user_name">By (<span class="far fa-user">{{$item->seller->name}}</span>)</div>
			</div>
		</div>
	@endforeach
</div>

<script>
	{{-- image zoom --}}
	$(".card-img-top").ezPlus({zoomWindowWidth: 300, zoomWindowHeight: 350, cursor: "crosshair",});

	{{-- add whishlist --}}
	$(".unlike").click(function () {
		let id = $(this).attr('data-id')
		let unlike = $(this)
		$.ajax({
			url: "{{url('/user/wishlist')}}",
			type: "post",
			data: {
				_token: "{{csrf_token()}}",
				id,
			},
			success: function(r) {
				unlike.removeClass("far")
				unlike.addClass("fas")
			}
		})
	})

	{{-- remove to wishlist --}}
	$(".like").click(function () {
		let id = $(this).attr('data-id')
		let like = $(this)
		$.ajax({
			url: "{{url('/wishlist/rm')}}",
			type: "post",
			data: {
				_token: "{{csrf_token()}}",
				id,
			},
			success: function(r) {
				like.removeClass("fas")
				like.addClass("far")
			}
		})
	})

	{{-- add to cart --}}
	$(".cart").click(function () {
		let id = $(this).attr('data-id')
		$.ajax({
			url: "{{url('/user/cart')}}",
			type: "post",
			data: {
				_token: "{{csrf_token()}}",
				id,
			},
			success: function(r) {
				$("#c_count").html(r)
			}
		})
	})

</script>

<style>
	.card-body .name {text-shadow: 0px 3px 0px #b2a98f; color: red; opacity: 0.9}
	.card-body .card-text, .symbol {opacity: 0.8; font-size: 1vw}

	.card-body img {width: 52%; height: 20vh; margin-left: 20%}

	.cart {position: relative; left: 30%; top: 18vh; font-size: 1.6vw; opacity: 0.7; cursor: pointer; z-index: 2}
	.unlike {position: relative; left: 17%; top: 11vh; font-size: 1.6vw; opacity: 0.7; cursor: pointer; z-index: 2;}
	.like {position: relative; left: 17%; top: 11vh; font-size: 1.6vw; opacity: 0.8; cursor: pointer; z-index: 2;}

	.fa-user {font-size: 12px; opacity: 0.7}
</style>

@endsection


