<?php

// Route::controller(Controller::detect());

// initial screen user lands on - home
Route::group(array('before' => 'auth.login'), function()
{
	Route::get('/', array('as' => 'home', function()
	{
		return View::make('index');
	}));
});

Route::get('/login', array(
	'as' => 'login',
	'uses' => 'LoginController@showLogin'
	)
);

Route::post('/login', array(
	'as' => 'login',
	'uses' => 'LoginController@doLogin'
	)
);

Route::get('/player/{playerid}', array(
					'as' => 'player',
					'uses' => 'PlayerController@areYouPlaying'
					)
)->where('playerid', '\d+');

Route::post('/player/{playerid}', array(
					'as' => 'playingresponse',
					'uses' => 'PlayerController@playingResponse'
					)
)->where('playerid', '\d+');

Route::get('/player/notfound', function()
{
	$message = Session::get('message');
	if (! $message) {
		return Redirect::route('home');
	}
	return View::make('playernotfound', compact('message'));
});

App::missing(function($exception)
{
	return Response::view('notfound', array(), 404);
});
// Route::resource('player', 'PlayerController');

// handle the form submition
// Route::post('/are-you-playing', array(
// 									'as' => 'areyouplaying', 
// 									'before' => 'csrf',
// 									function()
// {
//     // Handle our posted form data.
// }));


// base template test
// Route::get('/base', array('as' => 'home', function()
// {
// 	return View::make('base');
// }));