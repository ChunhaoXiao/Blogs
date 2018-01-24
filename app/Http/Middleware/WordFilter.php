<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class WordFilter
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
        if(!config('allowcomment')) 
        {
            return response()->json(['errors' => '当前禁止评论'], 400);
        }
        $user = Auth::user();
        if(isset($user->forbid['comment']))
        {
            return response()->json(['errors' => '你被博客管理员禁止发言'], 400);
        }    
        $words = explode(',', config('wordfilter'));
        foreach($words as $word)
        {
            if(strpos($request->content, $word) !== false)
            {
                return response()->json(['errors'=>'评论里含有非法内容:'.$word], 400);
            }   
        }   
        return $next($request);
    }
}
