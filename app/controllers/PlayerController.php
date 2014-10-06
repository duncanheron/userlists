<?php
// app/controllers/PlayerController.php

class PlayerController extends \BaseController {

	protected $player;
	protected $playersplaying;

	public function __construct(User $user, UsersAttending $usersAttending)
	{
		$this->player = $user;
		$this->playersplaying = $usersAttending;
	}

	private function checkUserExists($user)
	{
		if ($user) {
			return true;
		}
		return false;
	}

	public function checkplayer()
	{
		$email = Input::get('email');
		
		$currentPlayer = $this->player->getPlayerByEmail($email);
		
		if ($this->checkUserExists($currentPlayer)) {
			return Redirect::route('player', array(
					'playerid' => $currentPlayer->id
				)
			)/*->with('player_submittion', 'true')*/; 
		}

		return Redirect::route('home')
			->with('messagetitle', 'Oops...there was a problem')
			->with('message', 'You dont seem to be on the list.')
			->with('messageclass', 'error');
	}

	public function areYouPlaying($player_id)
	{
		/*if (! Session::has('player_submittion')) {
			return Redirect::route('home')
				->with('message', 'You must first enter your email!')
				->with('messageclass', 'error'); 
		}*/

		$currentPlayer = $this->player->with('playerhistory')->find($player_id);
		if (! $this->checkUserExists($currentPlayer)) {
			return Redirect::route('home')
				->with('messagetitle', 'Oops...there was a problem')
				->with('message', 'There was a problem with your user, enter your email.')
				->with('messageclass', 'error'); 
		}

		// $respondedForThisWeek = $this->alreadyRespondedThisWeek($currentPlayer->id);
		$respondedForThisWeek = $this->playersplaying
			->where('player_id', $currentPlayer->id)
			->responded()
			->get()
			->first();

		return View::make('footballplayer')
			->with('player', $currentPlayer)
			->with('playerhistory', $currentPlayer->playerhistory)
			->with('responded', $respondedForThisWeek);
	}

	public function playingResponse()
	{
		$response = Input::get('response');
		$player_id = Input::get('player_id');

		/*if (! $response) {
			return $this->redirectToPlayer($player_id);
		}*/

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

	/*private function alreadyRespondedThisWeek($playerid)
	{

		$responded = $this->playersplaying->where('player_id', $playerid)
			->responded()
			->get()
			->first();
		// print "<pre>";
		// print_r($responded);
		// print "</pre>";exit;
		if ($responded){
			return $responded;
		}

		return false;
	}*/

	

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