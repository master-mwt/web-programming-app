<?php

namespace App\Http\Middleware;

use Closure;

class CheckHardBanned
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
        if(auth()->check()){
            if(auth()->user()->hard_banned){
                auth()->logout();

                return redirect()->route('login')->withMessage('Your account has been banned from this site');
            }
        }
        return $next($request);
    }
}
