<?php

if(!function_exists('activeLink')){
	function activeLink($key, $segment = 2){
		$currentSegment = request()->segment($segment);
		return $key === $currentSegment ? 'active' : '';
	}
}

if(!function_exists('getDateAndTime')){
	function getDateAndTime($dateString){
		$date = date("Y-m-d", strtotime($dateString));
		$time = date("g:iA", strtotime($dateString));
		return $date . ' ' . $time;
	}
}

if(!function_exists('getOnlyDate')){
	function getOnlyDate($dateString){
		$date = date("Y-m-d", strtotime($dateString));
		return $date;
	}
}

if(!function_exists('flashSettings')){
	function flashSettings(){
		$settings = new \App\Models\Setting();
		$settings->welcome_text_message = 'unset';
		$settings->welcome_voic_message = 'unset';
		$settings->voic_before_live = 'unset';
		$settings->whatsapp_number = 'unset';
		$settings->auction_name = 'House of Amber';
		$settings->site_logo = 'unset';
		$settings->save();
		return $settings;
	}
}

if(!function_exists('settings')){
	function settings(){
		$settings = \App\Models\Setting::orderBy('id', 'desc')->with('addPhotos')->first();
		if(!isset($settings))
			$settings = flashSettings();
		return $settings;
	}
}