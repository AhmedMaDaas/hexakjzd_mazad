<?php

namespace App\Http\Controllers\user_controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

use App\Http\Controllers\Classes\logClass;
use App\Http\Controllers\Classes\homeClass;

use App\Http\Controllers\Classes\StructureClasses\liveClass;


class logController extends Controller
{
	private $logClass;
	private $homeClass;

	function __construct(logClass $logClass , homeClass $homeClass , liveClass $liveClass){
		$this->logClass = $logClass;
		$this->homeClass = $homeClass;
        $this->liveClass = $liveClass;
	}

    function  getLogPage(){
    	if(session('login') || \Cookie::get('remembered')){
    		return \Redirect::route('home.get');
    	}else{
	    	$ads = $this->logClass->getAds();
	    	$arr = [
	    		'ads' => $ads,
	    	];

	    	return view('user_layouts.sign-in',$arr);
	    }
    }

    function postLogPage($service){
    	/*
        * using session remember_me to check it when service return callback method
        *
        *
        */
    	if($service == 'facebook'){
            return $this->redirectToService($service/*,$remember_me*/);
            // session(['remember_me'=>$remember_me]);
            // return Socialite::driver('facebook')->redirect();
        }
    }

    function redirectToService($service/*,$remember_me*/){
        //session(['remember_me'=>$remember_me]);
        return Socialite::driver($service)->redirect(); 
    }

    function callback($service){
        try {

            $user = Socialite::with($service)->user();

            $fileContents = file_get_contents($user->getAvatar(1920).'&access_token='.$user->token);
            $pathPhoto = 'profile/' . $user->getId() . ".jpg";
            $publicPath = str_replace('files/', '', public_path());
            \File::put($publicPath . '/storage/'.$pathPhoto, $fileContents);
            //dd($user->getAvatar().'&access_token='.$user->token);
            // $request = new Request([
            //     'email' => $user->getEmail(),
            // ]);

            // $this->validate($request, [
            //     'email' => 'unique:users',
            // ]);
            $state = $this->logClass->loginByService($service,$user->getId(),$user->getName(),$user->getEmail(),$pathPhoto/*,session('remember_me')*/);
            //session()->forget('remember_me');
            if(!$state)return \Redirect::route('login')->with('failed', 'you cant login with your facebook try another acount');
            //if(session('back'))return \Redirect::to(session('back'));
            return \Redirect::route('home.get');


        } catch (Exception $e) {


            return \Redirect::route('login')->with('failed', 'something its get failed');


        }
    }

    function getWelcomePage(){
    	if(session('login') || \Cookie::get('remembered')){
    		if(!session('login'))session(['login'=>\Cookie::get('remembered')]);
    		$ads = $this->logClass->getAds();
    		$user = $this->logClass->getUserInfo();
	    	$live = $this->homeClass->getLive();
	    	if(!is_null($live) && $live->live_status == 'started')return \Redirect::route('login');
	    	//elseif(is_null($live))
            $welcomeInfo = $this->logClass->getWelcomeInfo();
	    	$arr = [
	    		'ads' => $ads,
	    		'user' => $user,
	    		'live' => $live,
                'welcomeInfo'=> $welcomeInfo,
	    	];
	    	return view('user_layouts.welcome',$arr);
    	}else{
    		return \Redirect::route('login');
    	}
    	
    }

    function logout(){
        
        if(session('live_id'))
            $this->liveClass->discountViewsFunction();

        session()->flush();

        return \Redirect::route('login')->withCookie(\Cookie::forget('remembered'));
    }
}
