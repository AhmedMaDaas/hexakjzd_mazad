<?php
namespace App\Http\Controllers\Classes;

use App\Http\Controllers\Classes\logClass;

use App\Models\StoreLink;
use App\Models\Interaction;
use App\Models\Live;
use App\Models\Commint;
use App\Models\Auction;
use App\Models\RobotCommint;
use \Carbon\Carbon;

class homeClass{

	private $logClass;
	function __construct(logClass $logClass){
		$this->logClass = $logClass;
	}

	function getUserInfo(){
		$user = $this->logClass->getUserInfo();
		return $user;
	}

	function getStoreLinks(){
		$storeLinks = StoreLink::all();
		return $storeLinks;
	}

	function getInteractions(){
		$interactions = Interaction::orderBy('id','desc')->get();
		return $interactions;
	}

	function getLive(){
		date_default_timezone_set("Asia/Beirut");
		$currentDate = Carbon::now();
		//dd($currentDate);
		$lives = Live::where('live_status','started')
					->orWhere(function($query)use($currentDate){
						$query->orderBy('live_start','asc')
							  ->where('live_status','not_yet');
					})
					->orderBy('live_start','asc')
					->with(['interactions'=>function($query){
						   		$query->with('user');
						   }])
					->with('shares')
					->get();

		foreach ($lives as $key => $live) {
			if($live->live_status == 'started') return $live;
		}
		
		if(count($lives))
	      return $lives[0];
	    else return null;

		// if(!is_null($live)){
		// 	if($live->live_status != 'started' && ($currentDate >= $live->live_start)){
		// 		$live->live_status = 'started';
		// 		$live->save();
		// 	}
		// }
		
		//return $live;
	}

	function getEndTimeOfLive($live,$timerPause=null){
		//add live_start to timer of live
		date_default_timezone_set("Asia/Beirut");
		$endTime = Carbon::createFromFormat('Y-m-d H:i:s', $live->live_start);
		if(!is_null($timerPause)){
			$his = explode(":",$timerPause);
		}else{
			$his = explode(":",$live->timer);
		}
		
		$endTime = $endTime->addHour($his[0])->addMinute($his[1])->addSecond($his[2]);

		return $endTime;

	}


// ->with(['interactions'=>function($query){
	// 					   		$query->select('interaction_id')
	// 					   		->groupBy('interaction_id');
	// 					   }])

	function getCommints($liveId){
		$commints = Commint::where('live_id',$liveId)
						   ->whereNull('parent')
						   ->with(['interactions'=>function($query){
						   		$query->with('user');
						   }])
						   ->with(['child'=>function($query){
						   		$query->with('user')
						   			  ->orderBy('created_at','desc');
						   }])
						   ->with('user')
						   ->get();

		return $commints;
	}

	function getBigValue($liveId){
		$auction = Auction::where('live_id',$liveId)
						  ->where('product_status',0)
						  ->orderBy('price','desc')
						  ->orderBy('created_at','asc')
						  ->with('user')
						  ->first();
		return $auction;
	}

	function checkLiveStart($live){
		date_default_timezone_set("Asia/Beirut");
		$currentDate = Carbon::now();

		if($live->live_start <= $currentDate)
			return true;

		return false;
	}

	function getRobots(){
		$robotCommint = RobotCommint::with('user')
									->with('commint')
									->get();
		return $robotCommint;
	}

	function getWinner(){
		$auction = Auction::where('user_id',session('login'))->where('live_id',session('live_id'))->where('winner',1)->first();
		return $auction;
	}
}