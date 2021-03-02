<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WinnerBill extends Model
{
    protected $table = 'winners_bills';

    protected $fillable = [
    	'user_id',
		'live_id',
		'final_price',
        'auction_id',
		'payment_method',
		'id_payment',
    ];

    public function user(){
    	return $this->belongsTo('App\Models\User');
    }

    public function live(){
    	return $this->belongsTo('App\Models\Live');
    }
}
