@extends('layouts.app')

@section('title')
login
@endsection

@section('logCss')
<style>

	form {
		height: 58vh;
		border-color: #DBBC00 !important;
		margin-top: 4%;
	}

	#stext {
		margin: 11% 0 0 29%;
		opacity: 0.8;
		font-size: 2.4vw;
		font-weight: bold;
		color: #193E45;
	}

	#ltext {
		margin-top: 2%;
		margin-left: 7%;
		color: #193E45;
	}

	#log, #pass{
		opacity: 0.8;
		width: 72%;
		border: 0;
		border-radius: 4px;
		padding: 0.6vw 0.8vw;
		margin-left: 13%;
		background-image: linear-gradient( 135deg, #FDEB71 10%, #F8D800 100%);
		color: #646E72;
	}#log {
		margin-top: 9%;
	}#pass {
		margin-top: 6%;
	}#log:focus, #pass:focus {
		opacity: 1;
	}
	label{
		width: 80%;
		margin-left: 11%;
		font-size: 0.8vw;
		color: red;
		font-weight: bold;
	}


	button {
		width: 72%;
		margin: 6% 0% 0% 13%;
		padding: 3% 0 3% 0;
		border: 0;
		border-radius: 4px;
		opacity: 0.8;
		color: #646E72;
		background-image: linear-gradient(135deg, #FDEB71 10%, #F8D800  100%);
		transition: 0.5s all ease;

	}button:hover {
		opacity: 0.8;
		background: #193E45;
		color: #FAE02E;
	}
	

	#dont {
		width: 80%;
		margin: 8% 0 6% 10%;
		font-size: 1.1vw;
		color: #193E45;
	}#dont a {
		font-size: 1.1vw;
		color: #646E72;
	}
	


</style>
@endsection
