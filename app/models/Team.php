<?php
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Team extends Eloquent {

    protected $table = 'teams';
    protected $fillable = array(
        'id',
        'name', 
        'created_at', 
        'updated_at'
    );

    public function players()
    {
        return $this->hasMany('User');
    }


}