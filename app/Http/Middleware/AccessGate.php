<?php

namespace App\Http\Middleware;

use Closure;
use Auth ;

class AccessGate
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
        $ip = $request->ip();
        if(in_array($ip, explode(',', config('ipfilter'))))
        {
            abort(404,'access denied');
        }  
        $user = Auth::user();
        if($user)
        {
            if(isset($user->forbid['access']))
            {
                abort(404,'access denied');
            }  
        }
       
        return $next($request);
    }
}
