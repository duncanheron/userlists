@extends('base')
@section('body')
	
	<div id='are_you_playing'>
		{{Form::open(
			array(
				'action' => array(
					'PlayerController@playingResponse', 'playerid' => $player->id
				), 
				'id' => 'email_check'
			)
		)}}
		<h1>Hello {{ $player->firstname }}</h1>
		
		@if (! ($responded)) 
			<p>Let us know if you are playing this week.</p>
		@elseif ($responded->response == 1) 
			<p class="playing">You are playing this week!</p>
		@elseif ($responded->response == 0)
			<p class="notplaying">You have said you can't make it this week.</p>
			<p class="notplaying">You can still change your mind......</p>
		@endif
		
			<fieldset id="inputs">
				<div class="slideThree">
					<input type="hidden" name="response" value="0" />
					<input type="checkbox" value="1" id="slideThree" name="response" @if ($responded) @if ($responded->response == 1) checked=checked @endif @endif/>
					<label for="slideThree"></label>
				</div>
			</fieldset>
			<fieldset id="actions">
				<input type="hidden" name="player_id" value="{{ $player->id }}" />
				{{ Form::submit('Respond', 
					array('id' => 'submit')) }}
			</fieldset>

		@if ($playerhistory)
			<h2>history</h2>
			@foreach ($playerhistory as $played)
			    <p>Played {{ $played->week_as_int }}</p>
			@endforeach
		@endif
		{{ Form::close() }}

	</div>
@stop
<!-- Slide THREE -->
