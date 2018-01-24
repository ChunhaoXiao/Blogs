<?php

namespace App\Http\Middleware;

use Closure;

class ViewTimes
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
        $post = $request->post ;
        if($post && !session('ip'.$post->id))
        {
            session(['ip'.$post->id => 1]);
            $post->views += 1 ;
            $post->save();
        }
        
        return $next($request);
    }
}
