<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LikeOnCommint extends Model
{
    protected $table = 'likes_on_commints';

    protected $fillable = [
    	'user_id',
		'commint_id',
		'interaction_id',
    ];

    public function user(){
    	return $this->belongsTo('App\Models\User');
    }

    public function commint(){
    	return $this->belongsTo('App\Models\Commint');
    }

    public function interaction(){
    	return $this->belongsTo('App\Models\Interaction');
    }
}
