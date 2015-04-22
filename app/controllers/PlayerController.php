<?php
use Illuminate\Support\Contracts\MessageProviderInterface;

class PlayerController extends \BaseController {

    protected $player;
    protected $playerId;
    protected $playersplaying;
    protected $messages;

    public function __construct(
        UsersAttending $usersAttending,
        MessageProviderInterface $messages
        )
    {
        $this->player = Auth::user();
        $this->playerId = Auth::id();
        $this->playersplaying = $usersAttending;
        $this->messages = $messages;
    }

    public function currentWeekAction()
    {
        $respondedForThisWeek = $this->playersplaying
            ->where('player_id', $this->playerId)
            ->responded()
            ->get()
            ->first();

        $gameWeeks = $this->getAllTeamMatesResponses();
        $teams = $this->player->team()->get();
        return View::make('footballplayer')
            ->with('player', $this->player)
            ->with('teams', $teams)
            ->with('playerhistory', $this->player->userPlayingHistory)
            ->with('responded', $respondedForThisWeek)
            ->with('gameWeeks', $gameWeeks)
            ->with('messages', $this->messages->getMessageBag());
    }

    private function getAllTeamMatesResponses()
    {
        /**
         * Collect all the players responses
         * Organise them into gameweek keyed arrays
         * Populate with the User object
         */
        $allResponses = $this->playersplaying
            ->get();
        $gameWeeks = array();
        foreach($allResponses as $responses) {
            $gameWeeks[$responses->week_as_int][] = array(
                'user' => User::find($responses->player_id)
            );
        }
        if(is_array($gameWeeks)){
            ksort($gameWeeks);
            return $gameWeeks;
        }
        return false;
    }

    public function currentWeekResponseAction()
    {
        $response = Input::get('response');

        $playingRecord = $this->playersplaying->firstOrNew(
            array(
                'player_id' => $this->playerId,
                'week_as_int' => date("W")
            )
        );
        $playingRecord->response = $response;
        $playingRecord->save();

        if ($response == 1) {
            $this->messages
            ->add('success', 'See you there')
            ->flash();
        } else {
            $this->messages
            ->add('error', 'You can\'t make it :(')
            ->flash();
        }
        return Redirect::route('player')
            ->with('messages', $this->messages->getMessageBag()); 
    }

    private function redirectToPlayer()
    {
        return Redirect::route('player');
    }
}