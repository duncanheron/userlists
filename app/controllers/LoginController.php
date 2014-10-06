<?php
class LoginController extends \BaseController {

    public function showLogin() {
        return View::make('index');
    }
    
    public function doLogin() {

        $rules = array(
            'email'    => 'required|email',
            'password' => 'required|alphaNum|min:3'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('login')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {

            $userdata = array(
                'email'     => Input::get('email'),
                'password'  => Input::get('password')
            );

            if (Auth::attempt($userdata)) {

                // validation successful!
                // redirect them to the secure section or whatever
                // return Redirect::to('secure');
                // for now we'll just echo success (even though echoing in a controller is bad)
                // echo 'SUCCESS!';
                return Redirect::route('player'); 

            } else {

                // validation not successful, send back to form 
                return Redirect::to('login');

            }

        }
    }
}