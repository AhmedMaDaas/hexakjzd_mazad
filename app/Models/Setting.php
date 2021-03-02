<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';

    protected $fillable = [
    	'welcome_text_message',
		'welcome_voic_message',
		'whatsapp_number',
		'voic_before_live',
		'voic_before_live_status',
        'auction_name',
        'site_logo',
    ];

    public function addPhotos(){
    	return $this->hasMany('App\Models\AdvertisingPhoto');
    }
}
