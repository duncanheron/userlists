<?php

Route::group(array('before' => 'auth.login'), function()
{
    Route::get('/', array('as' => 'home', function()
    {
        return View::make('index');
    }));

    Route::get('/player',
        array(
            'as' => 'player',
            'uses' => 'PlayerController@currentWeekAction'
        )
    );

    Route::post('/player',
        array(
            'as' => 'playingresponse',
            'uses' => 'PlayerController@currentWeekResponseAction'
        )
    )->where('playerid', '\d+');
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

App::missing(function($exception)
{
    return Response::view('notfound', array(), 404);
});




Route::get('/player/notfound', function()
{
    $message = Session::get('message');
    if (! $message) {
        return Redirect::route('home');
    }
    return View::make('playernotfound', compact('message'));
});

// Route::resource('player', 'PlayerController');

// handle the form submition
// Route::post('/are-you-playing', array(
//                                  'as' => 'areyouplaying', 
//                                  'before' => 'csrf',
//                                  function()
// {
//     // Handle our posted form data.
// }));


// base template test
// Route::get('/base', array('as' => 'home', function()
// {
//  return View::make('base');
// }));