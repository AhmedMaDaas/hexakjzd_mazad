<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LikeOnLive extends Model
{
    protected $table = 'likes_on_lives';

    protected $fillable = [
    	'user_id',
		'live_id',
		'interaction_id',
    ];

    public function user(){
    	return $this->belongsTo('App\Models\User');
    }

    public function live(){
    	return $this->belongsTo('App\Models\Live');
    }

    public function interaction(){
    	return $this->belongsTo('App\Models\Interaction');
    }
}
