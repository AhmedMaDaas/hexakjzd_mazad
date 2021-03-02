<?php 

namespace App\Http\Controllers\Classes\StructureClasses;

use App\Http\Controllers\Classes\Interfaces\interfaceAddFromForm;

use App\Models\Commint;
use App\Models\User;
use App\Models\Interaction;
use App\Models\LiveShare;
use App\Models\LikeOnCommint;
use App\Models\CommentForRobot;

use App\Events\addCommint;
use App\Events\addReply;
use App\Events\deleteCommint;
use App\Events\editCommint;
use App\Events\addLikeOnCommint;

use App\Http\Controllers\Classes\homeClass;


class commintClass implements interfaceAddFromForm{

	private $homeClass;

	function __construct(homeClass $homeClass){
		$this->homeClass = $homeClass;
	}

	function add($request){
		if(auth()->guard('admin')->check()){
			$user = auth()->guard('admin')->user()->user;
		}else{
			$user = User::where('id',session('login'))->first();
		}

		if(is_null($user) || is_null($request->commint)) return response()->json(['operation'=>'failed']);
		$interactions = $this->homeClass->getInteractions();
		$commint = Commint::create(['user_id'=>$user->id,
									'live_id'=>session('live_id'),
									'commint'=>$request->commint]);
		$sharedLive = LiveShare::where('user_id',$user->id)->where('live_id',session('live_id'))->first();
		if(is_null($sharedLive)) $userSharedLive = false;
		else $userSharedLive = true;

		$arr = [
			'commintId' => $commint->id,
			'commint' => $request->commint,
			'approval' => $user->approval,
			'userName' => $user->name,
			'userPhoto' => $user->photo,
			'userId' => $commint->user_id,
			'interactions' => $interactions,
			'userSharedLive' => $userSharedLive,
			'fake' => $user->fake,
			'created_at' => $commint->created_at,

		];
		$view = View('user_layouts/ajax_views/ajax-commint',$arr)->render();


		event(new addCommint($commint->id,
							 $request->commint,
							 $user->approval,
							 $user->name,
							 $user->photo,
							 $user->id,
							 $view));

		return response()->json(['operation'=>'suc']);
	}

	function delete($request){

	 	$commint = Commint::where('id',$request->commintId)->first();

	 	if(is_null($commint)) return response()->json(['operation'=>'failed']);
	 	if(($commint->user_id != session('login')) && (!auth()->guard('admin')->check())) return response()->json(['operation'=>'failed']);

	 	//$commint->parent == null ? $reply=false : $reply=true;
	 	if($commint->parent == null) $reply = false;
	 	else $reply = true;

	 	if(!$reply)
	 		Commint::where('parent',$commint->id)->delete();

	 	$commint->delete();

	 	event(new deleteCommint($request->commintId,$reply));

	 	return response()->json(['operation'=>'suc']);

	 }

	 function edit($request){
		$commint = Commint::where('id',$request->commintId)->first();
		if(auth()->guard('admin')->check()){
			$user = auth()->guard('admin')->user()->user;
		}else{
			$user = User::where('id',session('login'))->first();
		}

		if(is_null($commint)|| is_null($user)) return response()->json(['operation'=>'failed']);
		if($commint->user_id != $user->id) return response()->json(['operation'=>'failed']);

		$commint->update(['commint'=>$request->editedCommint]);

		event(new editCommint($commint->id,$commint->commint));

		return response()->json(['operation'=>'suc']);
	}

	function addReplyFunction($request){
		if(auth()->guard('admin')->check()){
			$user = auth()->guard('admin')->user()->user;
		}else{
			$user = User::where('id',session('login'))->first();
		}

		if($request->commintId == null || is_null($user)) return response()->json(['operation'=>'failed']);

		$commint = Commint::create(['user_id'=>$user->id,
									'live_id'=>session('live_id'),
									'parent'=>$request->commintId,
									'commint'=>$request->reply,
						]);

		$sharedLive = LiveShare::where('user_id',$user->id)->where('live_id',session('live_id'))->first();
		if(is_null($sharedLive)) $userSharedLive = false;
		else $userSharedLive = true;

		$arr = [
			'replyId'=>$commint->id,
			'userPhoto'=>$user->photo,
			'approval'=>$user->approval,
			'userName'=>$user->name,
			'reply'=>$commint->commint,
			'userId'=>$commint->user_id,
			'userSharedLive' => $userSharedLive,
			'fake' => $user->fake,
			'created_at' => $commint->created_at,
		];

		$view = View('user_layouts.ajax_views.ajax-reply',$arr)->render();

		event(new addReply($view,$request->commintId,$user->id,$commint->id));

		return response()->json(['operation'=>'suc']);

	}

	function addLikeOnCommintFunction($request){
		$commint = Commint::where('id',$request->commintId)->first();

		if(auth()->guard('admin')->check()){
			$user = auth()->guard('admin')->user()->user;
		}else{
			$user = User::where('id',session('login'))->first();
		}

		if(is_null($commint)) return response()->json(['operation'=>'failed']);

		$userLikeCommint = LikeOnCommint::where('user_id',$user->id)->where('commint_id',$request->commintId)->first();

		$oldInteractionId = null;

		if(!is_null($userLikeCommint)){
			/*
			*	check if the user change the interation on the commint or he unlike it
			*
			*/
			if($userLikeCommint->interaction_id == $request->interactionId){
				$userLikeCommint->delete();
				$likes = $commint->likes - 1;
				$likeStatus = false;
			}else{
				$oldInteractionId = $userLikeCommint->interaction_id;
				$userLikeCommint->update(['interaction_id'=>$request->interactionId]);
				$likes = $commint->likes;
				$likeStatus = 'static';
			}
			
		}else{
			LikeOnCommint::create(['user_id'=>$user->id,
							   'commint_id'=>$request->commintId,
							   'interaction_id'=>$request->interactionId]);
			$likes = $commint->likes + 1;
			$likeStatus = true;
		}

		$commintAfterUpdate = Commint::where('id',$request->commintId)->update(['likes'=>$likes]);

		event(new addLikeOnCommint($likes,$likeStatus,$request->commintId,$request->interactionId,$oldInteractionId));

		return response()->json(['operation'=>'suc']);
		

	}

	function addRobotCommint($request){
		$user = User::where('id',$request->robotId)->first();

		if(is_null($user)) return response()->json(['operation'=>'failed']);

		$robotCommint = CommentForRobot::where('id',$request->robotCommintId)->first();

		if(is_null($robotCommint)) return response()->json(['operation'=>'failed']);

		$interactions = $this->homeClass->getInteractions();

		$commint = Commint::create(['user_id'=>$user->id,
									'live_id'=>session('live_id'),
									'commint'=>$robotCommint->comment]);

		// $sharedLive = LiveShare::where('user_id',session('login'))->where('live_id',session('live_id'))->first();
		// if(is_null($sharedLive)) $userSharedLive = false;
		// else $userSharedLive = true;

		$arr = [
			'commintId' => $commint->id,
			'commint' => $robotCommint->comment,
			'approval' => $user->approval,
			'userName' => $user->name,
			'userPhoto' => $user->photo,
			'userId' => $commint->user_id,
			'interactions' => $interactions,
			'userSharedLive' => true,
			'fake' => $user->fake,

		];
		$view = View('user_layouts/ajax_views/ajax-commint',$arr)->render();


		event(new addCommint($commint->id,
							 $request->commint,
							 $user->approval,
							 $user->name,
							 $user->photo,
							 $user->id,
							 $view));

		return response()->json(['operation'=>'suc']);

	}

}