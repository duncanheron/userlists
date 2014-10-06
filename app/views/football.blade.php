@extends('base')
@section('body')
	<div id='home'>

		{{ Form::open(array('route' => 'home', 'id' => 'email_check')) }}
		<h1>Tuesday football</h1>
			<fieldset id="inputs">
				{{ Form::text('email', 'Enter your email address...', 
					array('id' => 'email', 'autofocus' => 'autofocus')) }}
			</fieldset>
			<fieldset id="actions">
				{{ Form::submit('Continue', 
					array('id' => 'submit')) }}
			</fieldset>

		{{ Form::close() }}
	</div>
@stop
	