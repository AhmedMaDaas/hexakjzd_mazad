<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdvertisingPhoto extends Model
{
    protected $table = 'advertising_photos';

    protected $fillable = [
    	'setting_id',
		'photo',
    ];

    public function setting(){
    	return $this->belongsTo('App\Models\Setting');
    }
}
