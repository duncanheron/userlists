@extends('base')
@section('body')
	<div id='home'>

		{{ Form::open(array('route' => 'home', 'id' => 'email_check')) }}
		<h1>Page not found</h1>
		<p>Go to the <a href="{{ URL::route('home') }}">homepage</a>.</p>
	</div>
@stop
	