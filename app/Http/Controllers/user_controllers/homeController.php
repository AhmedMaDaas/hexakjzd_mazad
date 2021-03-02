<?php

namespace App\Http\Controllers\user_controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Controllers\Classes\homeClass;
use App\Http\Controllers\Classes\logClass;

use App\Http\Controllers\Classes\StructureClasses\commintClass;
// use App\Http\Controllers\Classes\StructureClasses\replyClass;
use App\Http\Controllers\Classes\StructureClasses\valueClass;
use App\Http\Controllers\Classes\StructureClasses\liveClass;
// use App\Http\Controllers\Classes\StructureClasses\likeOnCommintClass;
// use App\Http\Controllers\Classes\StructureClasses\editCommintClass;
// use App\Http\Controllers\Classes\StructureClasses\deleteCommintClass;
use App\Events\addCommint;

class homeController extends Controller
{
	private $homeClass,
            $logClass,
            $commintClass,
            $replyClass,
            $valueClass,
            $liveClass,
            $likeOnCommintClass,
            $editCommintClass,
            $deleteCommintClass;

	function __construct(homeClass $homeClass,
                         logClass $logClass,
                         commintClass $commintClass,
                         valueClass $valueClass,
                         liveClass $liveClass){

		$this->homeClass       = $homeClass;
        $this->logClass        = $logClass;
        $this->commintClass    = $commintClass;
        $this->valueClass      = $valueClass;
        $this->liveClass       = $liveClass;
	}

    function getHomePage(){
        if(session('login') || \Cookie::get('remembered')){
            if(!session('login'))session(['login'=>\Cookie::get('remembered')]);
        	$storeLinks = $this->homeClass->getStoreLinks();
        	$interactions = $this->homeClass->getInteractions();
            $user = $this->homeClass->getUserInfo();
        	$live = $this->homeClass->getLive();
        	if(is_null($live) || is_null($user) || $live->live_status != 'started')return \Redirect::route('welcome');
            session(['live_id'=>$live->id]);
        	$commints = $this->homeClass->getCommints($live->id);
            //dd($live->shares->contains('user_id',session('login')));
            //dd($commints[0]->interactions->contains('user_id',6));
            $bigValue = $this->homeClass->getBigValue($live->id);
            $welcomeInfo = $this->logClass->getWelcomeInfo();
            // if(!is_null($bigValue)){
            //     session(['bigValue'=>$bigValue->price,
            //              'winnerUser'=>$bigValue->user
            //         ]);
            // }else{
            //     session(['bigValue'=>0,
            //              'winnerUser'=>null
            //         ]);
            // }
           
            $endTimeOfLive = $this->homeClass->getEndTimeOfLive($live);
            $winner = $this->homeClass->getWinner();
        	// if($commints[1]->interactions->groupBy('interaction_id')->has(3))
        	// dd($commints[1]->interactions->groupBy('interaction_id')->get(3)->count());
        	//dd($bigValue);
            if(session('view') === false || session('view') === null){
                $this->liveClass->increaseViewsFunction($live);
                session(['view'=>true]);
                session(['view_number'=>0]);
            }
            session(['view_number' => 1 + session('view_number')]);
            //dd(session('view_number'));

        	$arr = [
        	'storeLinks' => $storeLinks,
        	'interactions' => $interactions,
            'user' => $user,
        	'live' => $live,
        	'commints' => $commints,
            'bigValue' => $bigValue,
            'endTimeOfLive' => $endTimeOfLive,
            'welcomeInfo'   => $welcomeInfo,
            'winner' => $winner,
        	];

        	return view('user_layouts.live',$arr);
        }else{
            return \Redirect::route('login');
        }
    }


    function addCommint(Request $request){

        if(!is_null($request->commint)){
            return $this->commintClass->add($request);
        }elseif(!is_null($request->value)){
            return $this->valueClass->add($request);
        }
    }

    function addLikeOnLive(Request $request){
        return $this->liveClass->addLike();
    }

    function addLikeOnCommint(Request $request){
        return $this->commintClass->addLikeOnCommintFunction($request);
    }

    function addReply(Request $request){
        return $this->commintClass->addReplyFunction($request);
    }

    function editCommint(Request $request){
        return $this->commintClass->edit($request);
    }

    function deleteCommint(Request $request){
        return $this->commintClass->delete($request);
    }

    function discountViews(){
        return $this->liveClass->discountViewsFunction();
    }

    function share(){
        return $this->liveClass->share();
    }
}
