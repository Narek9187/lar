@extends('layouts.app')

@section('title')
register
@endsection


@section('regCss')
<style>

	form{
		width: 35% !important;
		background: transparent !important;
		border-radius: 3px;
		border: 1px solid transparent;
		border-top: none;
		border-bottom: none;
		box-shadow: inset 0 1px 2px rgba(0,0,0,.39), 0 0px 1px, 0 0.8px 0;
	}.inp {
		opacity: 0.3;
		border-radius: 3px;
		border: 1px solid transparent;
		border-top: none;
		border-bottom: 1px solid #DDD;
		box-shadow: inset 0 1px 2px rgba(0,0,0,.39), 0 -1px 1px #FFF, 0 1px 0 #FFF;
	}
	label{z-index: 1}
	button {
		width: 36.8%;
		height: 7vh;
		font-family: 'Roboto', sans-serif;
		font-size: 0.8vw;
		letter-spacing: 2.5px;
		background-color: #fff;
		color: #2EE59D;
		border: none;
		border-radius: 45px;
	}
	button:hover {
		background-color: #2ee5be;
		box-shadow: 0px 15px 20px rgba(46, 229, 157, 0.4);
		color: #fff;
		transform: translateY(-7px);
	}
		
	.fh{
		position: sticky;
		top: -40px;
		left: 0;
		margin-left: 33.8%;
		text-shadow: 0px 3px 0px #b2a98f,
	            0px 14px 10px rgba(0,0,0,0.15),
	            0px 24px 2px rgba(0,0,0,0.1),
	            0px 34px 30px rgba(0,0,0,0.1);
		font-family: 'Sriracha', cursive;
		line-height: 0.8;
	}.head{
		background: transparent !important;
	}

	.rotate-shadows {
	  width: 40%;
	  height: 80vh;
	  position: relative;
	  bottom: 80vh;
	  left: 28%;
	  z-index: -1;
	}
	.rotate-shadows:after,
	.rotate-shadows:before {
	  content: "";
	  border-radius: 20%;
	  position: absolute;
	  top: 0;
	  left: 0;
	  width: 100%;
	  height: 100%;
	  transform-origin: center center;
	}
	.rotate-shadows:before {
	  box-shadow: inset 0 20px 0 rgba(0, 250, 250, 0.6), inset 20px 0 0 rgba(0, 200, 200, 0.6), inset 0 -20px 0 rgba(0, 150, 200, 0.6), inset -20px 0 0 rgba(0, 200, 250, 0.6);
	  animation: rotate-before 2s -0.5s linear infinite;
	}
	.rotate-shadows:after {
	  box-shadow: inset 0 20px 0 rgba(250, 250, 0, 0.6), inset 20px 0 0 rgba(250, 200, 0, 0.6), inset 0 -20px 0 rgba(250, 150, 0, 0.6), inset -20px 0 0 rgba(250, 100, 0, 0.6);
	  animation: rotate-after 2s -0.5s linear infinite;
	}
	@keyframes rotate-after {
	  0% {transform: rotateZ(0deg) scaleX(1) scaleY(1);}
	  50% {transform: rotateZ(180deg) scaleX(0.82) scaleY(0.95);}
	  100% {transform: rotateZ(360deg) scaleX(1) scaleY(1);}
	}
	@keyframes rotate-before {
	  0% {transform: rotateZ(0deg) scaleX(1) scaleY(1);}
	  50% {transform: rotateZ(-180deg) scaleX(0.95) scaleY(0.85);}
	  100% {transform: rotateZ(-360deg) scaleX(1) scaleY(1);}
	}

</style>
@endsection