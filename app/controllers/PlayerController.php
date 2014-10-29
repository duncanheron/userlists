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

        return View::make('footballplayer')
            ->with('player', $this->player)
            ->with('playerhistory', $this->player->userPlayingHistory)
            ->with('responded', $respondedForThisWeek)
            ->with('messages', $this->messages->getMessageBag());
    }

    public function currentWeekResponseAction()
    {
        $response = Input::get('response');
        // $player_id = Input::get('player_id');

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
            /*$messageTitle = 'See you there';
            $message = 'Rain or shine.';
            $messageClass = 'success';*/
        } else {
            $this->messages
            ->add('error', 'You can\'t make it :(')
            ->flash();
            /*$messageTitle = "You can't make it :(";
            $message = 'If this changes come back and let us know.';
            $messageClass = 'error';*/
        }
        // print_r($this->messages);die();
        return Redirect::route('player')
            // ->with('message', $message)
            // ->with('messagetitle', $messageTitle)
            // ->with('messageclass', $messageClass)
            ->with('messages', $this->messages->getMessageBag()); 
    }

    private function redirectToPlayer()
    {
        return Redirect::route('player');
    }
}