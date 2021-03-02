<?php

namespace App\Http\Controllers\Classes\StructureClasses;

use App\Models\LikeOnLive;
use App\Models\Live;
use App\Models\Auction;
use App\Models\CurrentWinner;
use App\Models\User;
use App\Models\LiveShare;
use App\Models\StoreLink;

use App\Events\addLikeOnLive;
use App\Events\addValue;
use App\Events\addView;
use App\Events\editTimer;
use App\Events\endLive;
use App\Events\hideLive;

use \Carbon\Carbon;


class liveClass{

	function __construct(){
		date_default_timezone_set("Asia/Beirut");
	}

	function addLike(){

		$live = Live::where('id',session('live_id'))->first();

		$userLikeLive = LikeOnLive::where('user_id',session('login'))->where('live_id',session('live_id'))->first();
		if(!is_null($userLikeLive) && $userLikeLive->interaction_id == 1){
			$userLikeLive->delete();
			$likes = $live->likes - 1;
		}else{
			LikeOnLive::create(['user_id'=>session('login'),
										  'live_id'=>session('live_id'),
										  'interaction_id'=>1]);
			$likes = $live->likes + 1;
		}

		
		
		$LiveAfterUpdate = Live::where('id',session('live_id'))->update(['likes'=>$likes]);
		
		$allLikes = $likes + $live->cheat_likes;

		event(new addLikeOnLive($allLikes,$live->cheat_likes));
		return response()->json(['operation'=>'suc']);

	}

	function changeLikes($request){
		if(!auth()->guard('admin')->check()) return response()->json(['operation'=>'failed']);

		$live = Live::where('id',session('live_id'))->first();

		if(is_null($live)) return response()->json(['operation'=>'failed']);

		$live->update(['cheat_likes'=>$request->cheatedLikes]);

		$allLikes = $live->cheat_likes + $live->likes;

		event(new addLikeOnLive($allLikes,$live->cheat_likes));

		return response()->json(['operation'=>'suc']);

	}

	function changeMinValue($request){

		$validator = \Validator::make($request->all(), [
                                    'minValue'=>'required|numeric',
                                    ]);
        if($validator->fails())
        return response()->json(['operation' => 'failed','errors' => $validator->errors() ]);

		if(!auth()->guard('admin')->check()) return response()->json(['operation'=>'failed']);

		$live = Live::where('id',session('live_id'))->first();

		if(is_null($live)) return response()->json(['operation'=>'failed']);

		Auction::where('live_id',session('live_id'))->where('product_status',0)->update(['product_status'=>1]);

		$live->update(['min_value'=>$request->minValue]);

		$currentWinner = CurrentWinner::first();
		if($currentWinner) $currentWinner->delete();
		// session(['bigValue'=>0,
		// 		 'winnerUser'=>'empty'
		// ]);

		event(new addValue(0,$live->min_value,$live->bargaining_value,'empty',0));

		return response()->json(['operation'=>'suc']);
	}

	function increaseViewsFunction($live){
		$live->update(['views'=>$live->views+1]);

		event(new addView($live->views,$live->cheat_views));
	}

	function discountViewsFunction(){
		
		// if(!session('view')) return response()->json(['operation'=>'failed']);
		// else session(['view'=>false]);
		
		if(session('live_id'))
			$live = Live::where('id',session('live_id'))->first();
		else
			return response()->json(['operation'=>'failed1']);

		if(is_null($live) || ($live->views-1) < 0) return response()->json(['operation'=>'failed']);

		if(session('view_number') > 0 && session('view')){
			session(['view_number' => session('view_number') - 1]);
		}
		if(session('view_number') === 0 && session('view')){
			session(['view' => false]);
			$live->update(['views'=>$live->views-1]);

			event(new addView($live->views,$live->cheat_views));
		}

		return response()->json(['operation'=>'suc']);
	}

	function changeViews($request){
		if(!auth()->guard('admin')->check()) return response()->json(['operation'=>'failed']);

		$live = Live::where('id',session('live_id'))->first();

		if(is_null($live)) return response()->json(['operation'=>'failed']);

		$live->update(['cheat_views'=>$request->cheatViews]);

		event(new addView($live->views,$live->cheat_views));

		return response()->json(['operation'=>'suc']);
	}

	function setWinner($request){
		if(!auth()->guard('admin')->check()) return response()->json(['operation'=>'failed']);

		// $live = Live::where('id',session('live_id'))->first();

		if(!session('live_id')) return response()->json(['operation'=>'failed']);

		$currentWinner = CurrentWinner::first();

		if(is_null($currentWinner)) return response()->json(['operation'=>'failed']);

		Auction::where('live_id',session('live_id'))
						->where('user_id',$currentWinner->user_id)
						->where('price',$currentWinner->big_value)
						->orderBy('created_at', 'desc')
						->first()
						->update(['winner'=>1]);

		Auction::where('live_id',session('live_id'))->where('product_status',0)->update(['product_status'=>1]);

		$currentWinner->delete();

		return response()->json(['operation'=>'suc']);

	}

	function changeTimer($request,$homeClass){

		$live = Live::where('id',session('live_id'))->first();

		if(is_null($live)) return response()->json(['operation'=>'failed']);

		//date_default_timezone_set("Asia/Beirut");
		$currentDate = Carbon::now();

		$live->update(['timer'=>$request->timer,
					   'live_start'=>$currentDate,
					   'timer_pause'=>null
					   ]);

		//$currentWinner = CurrentWinner::first();
		//if($currentWinner) $currentWinner->delete();

		$endTime = $homeClass->getEndTimeOfLive($live);
		$endTimeArray = explode(' ', $endTime);

		event(new editTimer($endTime,$endTimeArray[0],$endTimeArray[1],false,false));

		return response()->json(['operation'=>'suc']);
	}

	function pauseTimer($request){
		$live = Live::where('id',session('live_id'))->first();

		if(is_null($live)) return response()->json(['operation'=>'failed']);

		$live->update(['timer_pause'=>$request->timerPuse]);

		event(new editTimer(null,null,null,true,false));

		return response()->json(['operation'=>'suc']);
	}

	function playTimer($request,$homeClass){
		$live = Live::where('id',session('live_id'))->first();

		if(is_null($live)) return response()->json(['operation'=>'failed']);

		//date_default_timezone_set("Asia/Beirut");
		$currentDate = Carbon::now();

		$timerPause = $live->timer_pause;
		$live->update(['live_start'=>$currentDate,'timer_pause'=>null]);

		//***** get end time from timer_pause instead timer *******
		$endTime = $homeClass->getEndTimeOfLive($live,$timerPause);
		$endTimeArray = explode(' ', $endTime);

		event(new editTimer($endTime,$endTimeArray[0],$endTimeArray[1],false,false));

		return response()->json(['operation'=>'suc']);

	}

	function restartTimer($request,$homeClass){
		$live = Live::where('id',session('live_id'))->first();

		if(is_null($live)) return response()->json(['operation'=>'failed']);

		//date_default_timezone_set("Asia/Beirut");
		$currentDate = Carbon::now();

		$live->update(['live_start'=>$currentDate,'timer_pause'=>null]);

		$endTime = $homeClass->getEndTimeOfLive($live);
		$endTimeArray = explode(' ', $endTime);

		event(new editTimer($endTime,$endTimeArray[0],$endTimeArray[1],false,false));

		return response()->json(['operation'=>'suc']);
	}

	function stopTimer($request,$homeClass){
		$live = Live::where('id',session('live_id'))->first();

		if(is_null($live)) return response()->json(['operation'=>'failed']);

		$live->update(['timer'=>'00:00:00','timer_pause'=>null]);

		$endTime = $homeClass->getEndTimeOfLive($live);
		$endTimeArray = explode(' ', $endTime);

		event(new editTimer($endTime,$endTimeArray[0],$endTimeArray[1],false,false));

		return response()->json(['operation'=>'suc']);
	}

	function changeBargainingValue($request){
		$live = Live::where('id',session('live_id'))->first();

		if(is_null($live)) return response()->json(['operation'=>'failed']);

		$live->update(['bargaining_value'=>$request->bargainingValue]);

		$currentWinner = CurrentWinner::first();
		$bigValue = 0;
		$winnerUserName = 'empty';
		$winnerUserId = 0;
		if(!is_null($currentWinner)){
			$bigValue = $currentWinner->big_value;
			$winnerUser = User::where('id',$currentWinner->user_id)->first();
			$winnerUserName = $winnerUser->name;
			$winnerUserId = $winnerUser->id;
		} //$currentWinner->delete();


		event(new addValue($bigValue,$live->min_value,$live->bargaining_value,$winnerUserName,$winnerUserId));

		return response()->json(['operation'=>'suc']);
	}

	function startLive($request,$homeClass){
		$live = Live::where('id',session('live_id'))->first();

		if(is_null($live)) return response()->json(['operation'=>'failed']);

		$currentDate = Carbon::now();
		$live->update(['live_status'=>'started','live_start'=>$currentDate]);

		$endTime = $homeClass->getEndTimeOfLive($live);
		$endTimeArray = explode(' ', $endTime);

		event(new editTimer($endTime,$endTimeArray[0],$endTimeArray[1],false,true));

		return response()->json(['operation'=>'suc']);
	}

	function endLive($request){
		$live = Live::where('id',session('live_id'))->first();

		if(is_null($live)) return response()->json(['operation'=>'failed']);

		$live->update(['live_status'=>'finished','timer_pause'=>null]);

		event(new endLive(true));
		return response()->json(['operation'=>'suc']);
	}


	function share(){
		if(!session('live_id')&&!session('login')) return response()->json(['operation'=>'failed']);

		 LiveShare::create(['user_id'=>session('login'),'live_id'=>session('live_id')]);

		 return response()->json(['operation'=>'suc']);
	}

	function hideLive(){
		$live = Live::where('id',session('live_id'))->first();

		if(is_null($live)) return response()->json(['operation'=>'failed']);

		if($live->hide_live){
			$live->update(['hide_live'=>0]);
			event(new hideLive(false));
		}else{
			$live->update(['hide_live'=>1]);
			event(new hideLive(true));
		}
			

		// event(new hideLive(true));
		return response()->json(['operation'=>'suc']);
	}
}