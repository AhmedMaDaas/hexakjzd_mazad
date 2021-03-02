<?php

namespace App\Http\Controllers\Classes\StructureClasses;
	
use App\Models\User;
use App\Models\Commint;

use App\Events\blockUser;

class userClass{

	function block($request){
		//if(!auth()->guard('admin')->check()) return response()->json(['operation'=>'failed']);

		$user = User::where('id',$request->userId)->first();

		if(is_null($user)) return response()->json(['operation'=>'failed']);
		$commints = Commint::where('user_id',$user->id)->where('live_id',session('live_id'));
		$commintsIds = $commints->pluck('id')->toArray();
		$commints->delete();

		$user->update(['blocked'=>1]);

		event(new blockUser(true,$request->userId,$commintsIds));
		return response()->json(['operation'=>'suc']);
	}
}