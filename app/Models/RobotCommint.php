<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RobotCommint extends Model
{
    protected $table = 'robots_commints';

    protected $fillable = [
    	'commint_id',
    	'user_id',
    ];

    public function user(){
    	return $this->belongsTo('App\Models\User');
    }

    public function commint(){
        return $this->belongsTo('App\Models\CommentForRobot','comment_for_robot_id');
    }
}
