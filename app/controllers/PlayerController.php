<?php

class PlayerController extends \BaseController {

    protected $player;
    protected $playerId;
    protected $playersplaying;

    public function __construct(User $user, UsersAttending $usersAttending)
    {
        // $user = Auth::user();
        // print "<pre>";
        // print_r($user);
        // print "</pre>";
        // die();
        $this->player = Auth::user();
        $this->playerId = Auth::id();
        $this->playersplaying = $usersAttending;
    }

    public function areYouPlaying()
    {
        // print "<pre>";
        // print_r($this->player);
        // print "</pre>";
        // die();
        
        /*$respondedForThisWeek = $this->playersplaying
            ->where('player_id', $this->playerId)
            ->responded()
            ->get()
            ->first();*/
        /*$respondedForThisWeek = $this->player->userPlayingHistory
            ->responded()
            ->get()
            ->first();
        print "<pre>ssss";
        print_r($respondedForThisWeek);
        print "</pre>";
        die();*/
        $respondedForThisWeek = 0;
        return View::make('footballplayer')
            ->with('player', $this->player)
            ->with('playerhistory', $this->player->userPlayingHistory)
            ->with('responded', $respondedForThisWeek);
    }

    public function playingResponse()
    {
        $response = Input::get('response');
        $player_id = Input::get('player_id');

        $playingRecord = $this->playersplaying->firstOrNew(
            array(
                'player_id' => $player_id,
                'week_as_int' => date("W")
            )
        );
        // if record found update it.
        $playingRecord->response = $response;
        $playingRecord->save();
        
        if ($response == 1) {
            $messageTitle = 'See you there';
            $message = 'Rain or shine.';
            $messageClass = 'success';

        } else {
            $messageTitle = "You can't make it :(";
            $message = 'If this changes come back and let us know.';
            $messageClass = 'error';
        }

        return $this->redirectToPlayer($player_id)
            ->with('message', $message)
            ->with('messagetitle', $messageTitle)
            ->with('messageclass', $messageClass); 
    }

    private function redirectToPlayer($player_id)
    {
        return Redirect::route(
            'player',
            array(
                'playerid' => $player_id
            )
        );
    }
}