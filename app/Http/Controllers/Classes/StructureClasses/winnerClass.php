<?php

namespace App\Http\Controllers\Classes\StructureClasses;

class winnerClass{
	public static $winnerUserObject = null,
				  $bigValue = 0;

	public static function setWinnerUser($user){
		self::$winnerUserObject = $user;
	}

	public static function setBigValue($bigValue){
		self::$bigValue = $bigValue;
	}

}