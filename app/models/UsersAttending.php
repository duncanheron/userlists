<?php
class UsersAttending extends Eloquent {
    protected $table = 'players_playing';
    protected $fillable = array(
        'player_id', 
        'week_as_int', 
        'id',
        'created_at',
        'updated_at',
        'response'
    );

    public function user()
    {
        return $this->belongsTo('User');
    }

    public function scopeResponded($query)
    {
        $gameWeek = date("W");
        return $query->where('week_as_int', '=', $gameWeek);
    }

    public function scopeRespondedPlaying($query)
    {
        return $query->where('response', '=', 1);
    }

    public function scopeRespondedNotPlaying($query)
    {
        return $query->where('response', '=', 0);
    }

    public function scopeAttendeesByGameweek($query, $gameWeek)
    {
        return $query->where('week_as_int', '=', $gameWeek);
    }
}