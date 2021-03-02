<?php

namespace App\Http\Controllers\Classes\StructureClasses;

use App\Models\Setting;

use App\Events\audioControl;
class audioClass{

	function __construct(){
		
	}

	function updateSetting($bool){
		$setting = Setting::first();

		$setting->update(['voic_before_live_status'=>$bool]);
	}

	function pauseAudio($request){
		
		$this->updateSetting(0);
		event(new audioControl(false,true,false,false));

		return response()->json(['operation'=>'suc']);
	}

	function playAudio($request){

		$this->updateSetting(1);

		event(new audioControl(true,false,false,false));

		return response()->json(['operation'=>'suc']);
	}

	function restartAudio($request){

		$this->updateSetting(1);

		event(new audioControl(false,false,true,false));

		return response()->json(['operation'=>'suc']);
	}

	function stopAudio($request){

		$this->updateSetting(0);

		event(new audioControl(false,false,false,true));

		return response()->json(['operation'=>'suc']);
	}

}