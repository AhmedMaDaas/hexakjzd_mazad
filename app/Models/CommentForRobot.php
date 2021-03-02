<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommentForRobot extends Model
{
    protected $table = 'comment_for_robots';

    protected $fillable = [
    	'timer',
		'comment',
    ];

    public function robotsCommints(){
        return $this->hasMany('App\Models\RobotCommint');
    }
}
