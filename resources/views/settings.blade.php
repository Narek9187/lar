@extends('layouts.app')

@section('title')
	settings
@endsection

@section("settingsCss")
	<style>
		.profile>div>label {width: 6%}
		/*.profile>div {margin-left: auto;}*/
		.profile input{
			opacity: 0.9;
			width: 20%;
			border: 0;
			border-radius: 4px;
			padding: 0.6vw 0.8vw;
			/*margin-left: 13%;*/
			margin-bottom: 0.5%;
			color: #646E72;
		}
		.profile>button {
			width: 72%;
			margin: 1% 0% 0% 13%;
			padding: 2% 0;
			border: 0;
			border-radius: 4px;
			color: #646E72;
			transition: 0.5s all ease;
		}
		.password>input:nth-of-type(2){margin-left: 13%;}
		.password>input{
			width: 16%;
			opacity: 0.9;
			border: 0;
			border-radius: 4px;
			padding: 0.6vw 0.8vw;
			margin-left: 6%;
			color: #646E72;
		}
		.password>button {
			width: 72%;
			margin: 1.5% 0% 0% 13%;
			padding: 2% 0;
			border: 0;
			border-radius: 4px;
			color: #646E72;
			transition: 0.5s all ease;
		}

	</style>
@endsection