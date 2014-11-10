@extends('base')
@section('body')
	<div id='home'>
		<p>
			{{ $errors->first('email') }}
			{{ $errors->first('password') }}
		</p>
		{{ Form::open(array('route' => 'login', 'id' => 'email_check')) }}
		<h1>Login</h1>
			<fieldset id="inputs">
				{{ Form::text('email', 'Enter your email address...', 
					array('id' => 'email', 'autofocus' => 'autofocus')) }}
			</fieldset>
			<fieldset id="inputspass">
				{{ Form::text('password', 'Password', 
					array('id' => 'password')) }}
			</fieldset>
			<fieldset id="actions">
				{{ Form::submit('Continue', 
					array('id' => 'submit')) }}
			</fieldset>

		{{ Form::close() }}
	</div>
@stop