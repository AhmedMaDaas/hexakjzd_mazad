<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreLink extends Model
{
    protected $table = 'store_links';

    protected $fillable = [
    	'name',
    	'image',
        'link'

    ];

    
}
