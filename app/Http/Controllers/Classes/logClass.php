<?php

namespace App\Http\Controllers\Classes;

use App\Models\User;
use App\Models\AdvertisingPhoto;
use App\Models\Setting;

class logClass{
	function loginByService($service,$service_id,$name,$email,$photo/*,$remember_me*/){
		if($service == 'facebook'){

			$coloum = 'facebook_id';

		}
		// elseif($service == 'google'){

		// 	$coloum = 'google_id';
		// }
		
		$user = User::where($coloum,$service_id)->first();
			if(empty($user)){
				$foundUser = User::where('email',$email)->whereNotNull('email')->first();
				if(!empty($foundUser))return false;
				$user = User::create(['name'=>$name,'email'=>$email,$coloum=>$service_id,'photo'=>$photo]);
			}else{
				User::where('id',$user->id)->update(['name'=>$name,'email'=>$email,$coloum=>$service_id,'photo'=>$photo]);
			}

			// if ($remember_me) {
		 //        $cookie =  \Cookie::queue('remembered', $user->id, time() + 31536000);
		 //    }else {

		 //    }

		session(['login'=>$user->id]);
		$cookie =  \Cookie::queue('remembered', $user->id, time() + 31536000);
		return true;
	}

	function getAds(){
		$ads = AdvertisingPhoto::all();
		return $ads;
	}

	function getUserInfo(){
		$user = User::where('id',session('login'))->first();
		return $user;
	}

	function getWelcomeInfo(){
		$welcomeInfo = Setting::first();

		return $welcomeInfo;
	}

}

