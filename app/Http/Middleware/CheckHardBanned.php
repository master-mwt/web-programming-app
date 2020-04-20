<?php

namespace App\Http\Middleware;

use App\UserHardBanned;
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
            $user_id = auth()->user()->id;
            if(UserHardBanned::where('user_id', $user_id)->first()){
                auth()->logout();

                return redirect()->route('login')->withMessage('Your account has been banned from this site');
            }
        }
        return $next($request);
    }
}
