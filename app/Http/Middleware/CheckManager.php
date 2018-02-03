<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckManager
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
        if(!Auth::check()) 
        {
            return redirect(route('admin.login'));
        }
        if(!Auth::user()->is_admin)
        {
            return redirect(route('indexes.index'));
        }    
		
        return $next($request);
    }
}
