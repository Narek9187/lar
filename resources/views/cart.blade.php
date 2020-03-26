@extends('layouts.app')

@section('title')
	cart
@endsection


@section("cartCss")
<style>
	.card-body .name {text-shadow: 0px 3px 0px #b2a98f; color: red; opacity: 0.9}
	.card-body span {opacity: 0.8; font-size: 0.94vw}

	.card-body img {width: 52%; height: 20vh; margin-left: 20%}

	.cart {position: relative; left: 27%; top: 18vh; font-size: 2vw; opacity: 0.7; cursor: pointer; z-index: 2}
	
	.move_wish {font-size: 1.1vw; position: relative; bottom: 7vh; left: 14%; cursor: pointer;}

	.fa-user {font-size: 12px; opacity: 0.7}

	#count {width: 22%; text-align: end; opacity: 0.8}
</style>
@endsection

@section("cartJs")
<script>
	{{-- image zoom --}}
	$(".card-img-top").ezPlus({zoomWindowWidth: 300, zoomWindowHeight: 350, cursor: "crosshair",});

	{{-- remove from cart --}}
	$(".del").click(function(){
		let id = $(this).attr('data-id')
		let d = $(this).parent().parent()
		$.ajax({
			url: "{{url('/user/cart/rm')}}",
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

	{{-- move to wishlist --}}
	$(".move_wish").click(function(){
		let id = $(this).attr('data-id')
		let d = $(this).parent().parent()
		$.ajax({
			url: "{{url('/user/cart/move')}}",
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


	// count value
	$(document).on('change',"#count",function(){
		let id = $(this).attr('data-id')
		let max = $(this).attr('max')
		let d = $(this).parent().parent()
		let price = $(this).parent().find(".price")
		let prod_id = $(this).parent().attr("data-id")
		// let price = $(this).parent().find(".price")
		let c = $(this).val()
		if (c == 0) {
			$.ajax({
				url: "{{url('/user/cart/rm')}}",
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
		}
		else if(c > 0 && c < Number(max)){
			$.ajax({
				url: "{{url('/user/cart/count')}}",
				type: "post",
				data: {
					_token: "{{csrf_token()}}",
					id,
					max,
					c,
					prod_id,
					// price
				},
				success: function(r) {
					price.html(r)
				}
			})
		}
	})
</script>
@endsection