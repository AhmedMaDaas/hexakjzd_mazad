<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Admin;

use App\Mail\ResetPassword;

use Carbon\Carbon;
use Password;
use DB;
use Mail;

class AuthController extends Controller
{
    public function login(){
    	$title = trans('admin.login');

    	return view('admin.auth.login', ['title' => $title]);
    }

    public function doLogin(){
    	$remember = request('remember') !== null ? true : false;

        $this->validate(request(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

    	if(auth()->guard('admin')->attempt(['email'=>request('email'), 'password'=>request('password')], $remember)){
    		return redirect('admin/settings');
    	}
    	else{
    		session()->flash('error', trans('admin.error_information_login'));
    		return redirect('admin/login');
    	}
    }

    public function logout(){
    	auth()->guard('admin')->logout();
    	return redirect('admin/login');
    }

    public function resetPassword(){
    	$title = trans('admin.reset_password');

    	return view('admin.auth.reset_password', ['title' => $title]);
    }

    public function resetPasswordPost(){
    	$admin = Admin::where('email', request('email'))->first();
    	
    	if(!empty($admin)){

            $token = Password::broker('admins')->createToken($admin);

    		$data = DB::table('password_resets')->insert([
    			'email' => $admin->email,
    			'token' => $token,
    			'created_at' => Carbon::now(),
    		]);

    		Mail::to($admin->email)->send(new ResetPassword(['name' => $admin->name, 'token' => $token]));
            session()->flash('success', trans('admin.reset_link_sent_successfully'));
    	}

    	return back();
    }

    public function resetPasswordToken($token){
        $checkToken = DB::table('password_resets')->where('token', $token)->where('created_at', '>', Carbon::now()->subHour(2))->first();
        if(!empty($checkToken)){
        	$title = trans('admin.reset_password');
            return view('admin.auth.reset_password_token', ['email'=> $checkToken->email, 'title' => $title]);
        }
        else{
            return redirect('admin/reset/password');
        }
    }

    public function resetPasswordTokenPost($token){
        $checkToken = DB::table('password_resets')->where('token', $token)->where('created_at', '>', Carbon::now()->subHour(2))->first();
        if(!empty($checkToken)){
            Admin::where('email', $checkToken->email)->update(['email'=>$checkToken->email, 'password'=> bcrypt(request('password'))]);
            DB::table('password_resets')->where('token', $token)->where('created_at', '>', Carbon::now()->subHour(2))->delete();
            auth()->guard('admin')->attempt(['email'=>$checkToken->email, 'password'=>request('password')], true);
            return redirect('admin/');
        }
        else{
            return redirect('admin/reset/password');
        }
    }
}
