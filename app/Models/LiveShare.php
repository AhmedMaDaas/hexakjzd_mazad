<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LiveShare extends Model
{
    protected $table = 'lives_shares';

    protected $fillable = [
    	'user_id',
		'live_id',
    ];

    public function user(){
    	return $this->belongsTo('App\Models\User');
    }

    public function live(){
    	return $this->belongsTo('App\Models\Live');
    }
}
