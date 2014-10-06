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

    public function scopeResponded($query)
    {
        $gameWeek = date("W");
        return $query->where('week_as_int', '=', $gameWeek);
    }
}