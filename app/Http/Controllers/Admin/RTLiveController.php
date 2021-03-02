<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Commint;

use App\Http\Controllers\Classes\StructureClasses\liveClass;
use App\Http\Controllers\Classes\StructureClasses\userClass;
use App\Http\Controllers\Classes\StructureClasses\commintClass;
use App\Http\Controllers\Classes\StructureClasses\audioClass;

use App\Http\Controllers\Classes\homeClass;
use App\Http\Controllers\Classes\logClass;


class RTLiveController extends Controller
{

	function __construct(homeClass $homeClass,
                         liveClass $liveClass,
                         userClass $userClass,
                         commintClass $commintClass,
                         logClass $logClass,
                         audioClass $audioClass){

		$this->homeClass        = $homeClass;
        $this->liveClass        = $liveClass;
        $this->userClass        = $userClass;
        $this->commintClass     = $commintClass;
        $this->logClass         = $logClass;
        $this->audioClass       = $audioClass;
	}

    function getRTLivePage(){
        $title = trans('admin.current_live');
    	$interactions = $this->homeClass->getInteractions();
    	$live = $this->homeClass->getLive();

        $user = auth()->guard('admin')->user()->user;
        session(['login'=>$user->id]);
        
    	if(is_null($live)) return \Redirect::route('welcome');
        session(['live_id'=>$live->id]);
        
        

    	$commints = $this->homeClass->getCommints($live->id);
    	$bigValue = $this->homeClass->getBigValue($live->id);
        $robots = $this->homeClass->getRobots();
        $welcomeInfo = $this->logClass->getWelcomeInfo();
        //$liveStart = $this->homeClass->checkLiveStart($live);
        //dd($live->live_start);
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

        $arr = [
        	//'storeLinks' => $storeLinks,
        	'interactions' => $interactions,
            //'user' => $user,
        	'live' => $live,
        	'commints' => $commints,
            'bigValue' => $bigValue,
            'robots'   => $robots,
            //'liveStart' =>$liveStart,
            'endTimeOfLive' => $endTimeOfLive,
            'welcomeInfo'   => $welcomeInfo,
            'title' => $title,
    	];
    	return view('admin.live.live-admin',$arr);
    }


    function changeLiveLikes(Request $request){
        return $this->liveClass->changeLikes($request);
    }

    function blockUser(Request $request){
        return $this->userClass->block($request);
    }

    function changeMinValue(Request $request){
        return $this->liveClass->changeMinValue($request);
    }

    function changeViews(Request $request){
        return $this->liveClass->changeViews($request);
    }

    function addRobotCommint(Request $request){
        return $this->commintClass->addRobotCommint($request);
    }

    function setWinner(Request $request){
        return $this->liveClass->setWinner($request);
    }

    function changeTimer(Request $request){
        return $this->liveClass->changeTimer($request,$this->homeClass);
    }

    function pauseTimer(Request $request){
        return $this->liveClass->pauseTimer($request);
    }

    function playTimer(Request $request){
        return $this->liveClass->playTimer($request,$this->homeClass);
    }

    function restartTimer(Request $request){
        return $this->liveClass->restartTimer($request,$this->homeClass);
    }

    function stopTimer(Request $request){
        return $this->liveClass->stopTimer($request,$this->homeClass);
    }

    function changeBargainingValue(Request $request){
        return $this->liveClass->changeBargainingValue($request);
    }

    function startLive(Request $request){
        return $this->liveClass->startLive($request,$this->homeClass);
    }

    function endLive(Request $request){
        return $this->liveClass->endLive($request);
    }

    function pauseAudio(Request $request,$status){
        if($status == 'pause')
            return $this->audioClass->pauseAudio($request);
        elseif($status == 'play')
            return $this->audioClass->playAudio($request);
        elseif($status == 'restart')
            return $this->audioClass->restartAudio($request);
        elseif($status == 'stop')
            return $this->audioClass->stopAudio($request);
        else
            return response()->json(['operation'=>'failed']);
    }

    function hideLive(Request $request){
        return $this->liveClass->hideLive();
    }
}
