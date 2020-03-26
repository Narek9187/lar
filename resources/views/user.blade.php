@extends('layouts.app')

@section('title')
	user_account
@endsection

@section('jq')
	<script>
			$(".edit").click(function(e){
				$(this).addClass("d-none")
				$(this).prev().removeClass("d-none")
				$(this).parent().children().attr("contenteditable", "true")
			})
			$(".save").click(function(){
				$(this).addClass("d-none")
				$(this).next().removeClass("d-none")
				$(this).parent().first().attr("contenteditable", "false")
				let id = $(this).attr('data-id')
				let n = $(this).parent().find('#name').html(); let p = $(this).parent().find('#price').html();
				let c = $(this).parent().find('#count').html(); let d = $(this).parent().find('#description').html();
				
				// e.preventDefault();
				if (confirm("Հաստատե՞լ փոփոխությունը")) {
					$.ajax({
						url: "/user/edit",
						type: "POST",
						data: {
							"_token":"{{csrf_token()}}",
							id,
							n,
							p,
							c,
							d
						},
						success: function(r) {
							alert("Տվյալները հաջողությամբ փոխվել են")
						}
					})
				}
			})

	</script>
@endsection


@section('userCss')
	<style>

		.form input {
			width: 18%;
			border-color: #f9d961;
		}
		.form button {
			opacity: 0.6;
		}
		.form button:hover {
			opacity: 0.8;
			background: #fcc700;
			border-color: #fcc700;
		}
		.card-body #name {text-shadow: 0px 3px 0px #b2a98f; color: red; opacity: 0.9}
		.card-body #user_name {font-size: 0.9vw}

		.card-body #price,  .card-body #count, .card-body #description {opacity: 0.8; font-size: 0.9vw; line-height: 1.1vw;}

		.card-body img {width: 50%; height: 20vh}
		
		.i {font-size: 0.9vw; opacity: 0.7}

		.more{font-size: 1vw}
		.save{padding-right: 4.4%;}
		
	
	</style>
@endsection

@section("zoom")
	<script>
		$(".card-img-top").ezPlus({
			zoomWindowWidth: 320, zoomWindowHeight: 300, cursor: "crosshair", lensOpacity: 0, borderSize: 5, borderColour: "white"
		});
	</script>
@endsection