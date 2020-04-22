<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ReadNotification
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
        if(Auth::check() && $request->has('readnotification')){
            $notification = $request->user()->notifications()->where('id', $request->readnotification)->first();
            if($notification){
                $notification->delete();
            }
        }
        return $next($request);
    }
}
