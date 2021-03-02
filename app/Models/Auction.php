<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    protected $table = 'auctions';

    protected $fillable = [
    	'user_id',
		'live_id',
		'price',
        'product_status',
		'winner',
    ];

    public function user(){
    	return $this->belongsTo('App\Models\User');
    }

    public function live(){
    	return $this->belongsTo('App\Models\Live');
    }
}
