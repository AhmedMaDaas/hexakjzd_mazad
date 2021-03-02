<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commint extends Model
{
    protected $table = 'commints';

    protected $fillable = [
    	'user_id',
		'live_id',
		'parent',
		'commint',
		'likes',
    ];

    public function replayes(){
        return $this->hasMany('App\Models\Commint', 'parent');
    }

    public function interactions(){
        return $this->hasMany('App\Models\LikeOnCommint');
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function replayedTo(){
        return $this->belongsTo('App\Models\Commint', 'parent');
    }

    public function live(){
        return $this->belongsTo('App\Models\Live');
    }

    public function child(){
       return $this->hasMany('App\Models\Commint', 'parent');
    }
}
