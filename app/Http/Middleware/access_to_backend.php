<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use App\GroupService;
use App\Service;

class access_to_backend
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
        $service = Service::where('name', 'access_to_backend')->first();

        if(Auth::check()) {
            return is_null(GroupService::where(['group_id' => Auth::User()->group_id, 'service_id' => $service->id])->first()) 
            ? abort(403) 
            : $next($request);
        }
        abort(403);
    }
}
