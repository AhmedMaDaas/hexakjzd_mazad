<?php

namespace App\Http\Middleware;

use Closure;

use App\Models\User;

class BlockedUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //dd(session('login'));
        if(session('login') || \Cookie::get('remembered')){
            if(!session('login'))session(['login'=>\Cookie::get('remembered')]);
            $user = User::where('id',session('login'))->first();
            if(is_null($user)){
                session()->flush();

                return \Redirect::route('login')->withCookie(\Cookie::forget('remembered'));
            }
            if($user->blocked == 1) return \Redirect::to('you-are-blocked');
            return $next($request);
        }else{
            
            return \Redirect::route('login');
        }
        
    }
}
