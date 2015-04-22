@extends('base')
    @if (($messages->has('success')))
        <div class="message success }}">
            {{ $messages->first('success') }}
        </div>
    @endif
    @if (($messages->has('error')))
        <div class="message error }}">
            {{ $messages->first('error') }}
        </div>
    @endif

@section('body')
    
    <div id='are_you_playing'>
        {{Form::open(
            array(
                'action' => array(
                    'PlayerController@currentWeekResponseAction', 
                    'playerid' => $player->id
                ), 
                'id' => 'email_check'
            )
        )}}
            <h1>Hello {{ $player->firstname }}</h1>
            @foreach ($teams as $team)
                <h2> {{ $team->name }}</h2>
            @endforeach
            @if (! ($responded)) 
                <p>Let us know if you are playing this week.</p>
            @elseif ($responded->response == 1) 
                <p class="playing">You are playing this week!</p>
            @elseif ($responded->response == 0)
                <p class="notplaying">You have said you can't make it this week.</p>
                <p class="notplaying">You can still change your mind......</p>
            @endif
        
            <fieldset id="inputs">
                    <input type="hidden" name="response" value="0" />
                    <input type="checkbox" value="1" name="response" @if ($responded) @if ($responded->response == 1) checked=checked @endif @endif/>
                    <label for="slideThreed">Yes</label>
            </fieldset>
            <fieldset id="actions">
                <input type="hidden" name="player_id" value="{{ $player->id }}" />
                {{ Form::submit('Respond', 
                    array('id' => 'submit')) }}
            </fieldset>
        {{ Form::close() }}
    </div>

    @if ($playerhistory)
    <div id="history" style="clear:both;">
        <h2>history</h2>
        @foreach ($playerhistory as $played)
            <p>Responded gameweek: {{ $played->week_as_int }} - {{ date("d M Y",strtotime($played->updated_at)) }}
            </p>
            <div>
                <ul>
                    <li>
                        You said: 
                        @if ($played->response == 1) 
                            Playing this week. :)
                        @elseif ($played->response == 0) 
                            Not playing this week. :(
                        @else
                            Error: no response found.
                        @endif
                    </li>
                    <li>Other players responses
                        <ul>
                            <?php
                            $thisgameWeek = array();
                            $thisgameWeek = $gameWeeks[$played->week_as_int] ?>
                            @foreach ($thisgameWeek as $key => $value) 
                                <li>{{ $value['user']->email }} - YES</li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
            </div>
        @endforeach
        </div> <!-- end history -->
    @endif

@stop
<!-- Slide THREE -->
