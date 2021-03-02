<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CurrentWinner extends Model
{
    protected $table = 'current_winner';

    protected $fillable = [
		'user_id',
		'big_value',
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
