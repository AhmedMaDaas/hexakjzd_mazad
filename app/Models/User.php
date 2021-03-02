<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'photo', 'phone', 'location', 'fake','attention', 'approval','facebook_id', 'blocked', 'shared_winner', 'admin_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function auctions(){
        return $this->hasMany('App\Models\Auction');
    }

    public function commints(){
        return $this->hasMany('App\Models\Comment');
    }

    public function commintsInteractions(){
        return $this->hasMany('App\Models\LikeOnCommint');
    }

    public function livesInteractions(){
        return $this->hasMany('App\Models\LikeOnLive');
    }

    public function shares(){
        return $this->hasMany('App\Models\LiveShare');
    }

    public function bills(){
        return $this->hasMany('App\Models\WinnerBill');
    }

    public function robotsCommints(){
        return $this->hasMany('App\Models\RobotCommint');
    }

    public function admin(){
        return $this->belongsTo('App\Models\Admin');
    }
}
