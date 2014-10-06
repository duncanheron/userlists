<?php
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface{

    protected $table = 'players';
    protected $fillable = array(
        'id',
        'firstname', 
        'lastname', 
        'email' ,
        'password', 
        'created_at', 
        'updated_at'
    ); 
    public function scopeResponded($query)
    {
        $gameWeek = date("W");
        return $query->where('week_as_int', '=', $gameWeek);
    }
    public function userPlayingHistory()
    {
        return $this->hasMany('UsersAttending', 'player_id');
    }

    public function getUserByEmail($email)
    {
        return $this->where('email', $email)->get()->first();
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Get the e-mail address where password reminders are sent.
     *
     * @return string
     */
    public function getReminderEmail()
    {
        return $this->email;
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }

}