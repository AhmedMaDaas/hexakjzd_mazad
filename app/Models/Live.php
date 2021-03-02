<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Live extends Model
{
    protected $table = 'lives';

    protected $fillable = [
        'views',
    	'description',
        'cheat_views',
        'likes',
        'cheat_likes',
        'live_status',
        'timer',
        'timer_pause',
        'min_value',
        'live_start',
        'bargaining_value',
        'hide_live',
    ];

    public function auction(){
    	return $this->hasOne('App\Models\Auction');
    }

    public function commints(){
    	return $this->hasMany('App\Models\Commint');
    }

    public function interactions(){
        return $this->hasMany('App\Models\LikeOnLive');
    }

    public function shares(){
        return $this->hasMany('App\Models\LiveShare');
    }

    public function bills(){
        return $this->hasMany('App\Models\WinnerBill');
    }
}
