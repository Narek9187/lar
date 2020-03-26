@extends('layouts.app')

@section('title')
	wishlist
@endsection

@section("wishlistCss")
<style>
	.card-body .name {text-shadow: 0px 3px 0px #b2a98f; color: red; opacity: 0.9}
	.card-body span {opacity: 0.8; font-size: 0.94vw}

	.card-body img {width: 52%; height: 20vh; margin-left: 20%}

	.cart {position: relative; left: 27%; top: 18vh; font-size: 2vw; opacity: 0.7; cursor: pointer; z-index: 2}
	
	.like {font-size: 1.1vw; position: relative; bottom: 7vh; left: 14%; cursor: pointer;}
	.move_cart {font-size: 1.1vw; margin-left: 92%; cursor: pointer;}

	.fa-user {font-size: 12px; opacity: 0.7}
</style>
@endsection

@section("wishlistJs")
<script>
	{{-- image zoom --}}
	$(".card-img-top").ezPlus({zoomWindowWidth: 300, zoomWindowHeight: 350, cursor: "crosshair",});

	{{-- remove from wishlist --}}
	$(".like").click(function(){
		let id = $(this).attr('data-id')
		let d = $(this).parent().parent()
		$.ajax({
			url: "{{url('/user/wishlist/rm')}}",
			type: "post",
			data: {
				_token: "{{csrf_token()}}",
				id,
			},
			success: function(r) {
				d.remove()
			}
		})
	})

	{{-- move to cart --}}
	$(".move_cart").click(function(){
		let id = $(this).attr('data-id')
		let d = $(this).parent().parent()
		$.ajax({
			url: "{{url('/user/wishlist/move')}}",
			type: "post",
			data: {
				_token: "{{csrf_token()}}",
				id,
			},
			success: function(r) {
				d.remove()
				$("#c_count").html(r)
			}
		})
	})
</script>
@endsection