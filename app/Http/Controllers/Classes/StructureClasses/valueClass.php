<?php

namespace App\Http\Controllers\Classes\StructureClasses;

use App\Http\Controllers\Classes\Interfaces\interfaceAddFromForm;

use App\Http\Controllers\Classes\homeClass;

use App\Models\User;
use App\Models\Auction;
use App\Models\Live;
use App\Models\CurrentWinner;

use App\Events\addValue;

use \Carbon\Carbon;



class valueClass implements interfaceAddFromForm{

	private $homeClass;
	function __construct(homeClass $homeClass){
		$this->homeClass = $homeClass;
	}

	function add($request){

		$user = User::where('id',session('login'))->first();

		if(is_null($user)||$user->approval == 0) return response()->json(['operation'=>'failed']);
		$live = Live::where('id',session('live_id'))->first();

		date_default_timezone_set("Asia/Beirut");
		$currentDate = Carbon::now();
		$endTime = $this->homeClass->getEndTimeOfLive($live);
		if($currentDate > $endTime) return response()->json(['operation'=>'failed']);

		$validator = \Validator::make($request->all(), [
                                    'value'=>'required|min:'.$live->min_value.'|numeric',
                                    ]);
        if($validator->fails())
        return response()->json(['operation' => 'failed','errors' => $validator->errors() ]);

		
		
		$auction = Auction::create(['user_id' => $user->id,
									'live_id' => session('live_id'),
									'price'	  => $request->value]);

		$currentWinner = CurrentWinner::first();
		if(is_null($currentWinner)){
			$currentWinner = CurrentWinner::create(['user_id'	=>$user->id,
													'big_value'=>$request->value
													]);
		}else{
			if($request->value > $currentWinner->big_value){
				$currentWinner->update(['user_id'	=> $user->id,
										'big_value' => $request->value
										]);
			}
		}

		$winnerUser = User::where('id',$currentWinner->user_id)->first();
		// if($request->value > session('bigValue')){
		// 	session(['bigValue'=>$request->value,
		// 			 'winnerUser'=>$user
		// 		]);
		// }

		event(new addValue($currentWinner->big_value,
						   $live->min_value,
						   $live->bargaining_value,
						   $winnerUser->name,
						   $winnerUser->id));
		return response()->json(['operation'=>'suc']);
		
	}

}