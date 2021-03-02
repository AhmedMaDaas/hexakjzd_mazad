<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Interaction extends Model
{
    protected $table = 'interactions';

    protected $fillable = [
    	'name',
		'icon',
    ];

    public function interactionOnComment(){
    	return $this->hasMany('App\Models\LikeOnCommint');
    }

    public function interactionOnLive(){
    	return $this->hasMany('App\Models\LikeOnLive');
    }
}
