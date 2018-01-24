<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment ;
use App\Models\Tag;

class IndexController extends Controller
{
	public function __construct()
	{
		$this->middleware('viewtimes')->only('show');
		
	}
	public function index(Request $request) 
	{   
		$perpage = config('perpage') ? config('perpage'): 5 ;
	    if($tag = $request->tag)
	    {
	    	$tag = Tag::where('name', $tag)->firstOrFail();
	    	if(!$tag)
	    	{
	    		abort(404,'内容不存在');
	    	}	
	    	$data = $tag->posts()->with(['pics','category'])->orderBy('created_at','desc')->paginate($perpage);
	    } 
	    else
	    {    //查询条件
	    	$where['ofCate'] = $request->category;
            $where['ofContent'] = $request->content;
            if($where = array_filter($where)){
	            foreach($where as $key => $value)
	            {
	                $query = isset($query) ? $query->$key($value) : Post::$key($value) ;
	            }    
            }
            isset($query) || $query = Post::query() ;
            $data = $query->with(['pics','category'])->orderBy('global_top','desc')->orderBy('created_at','desc')->paginate($perpage);
	    }
		
		
		return view('home.index.index',['data' => $data]);
	}

	public function show(Post $post) {
		$comment = $post->comments()->withCount('thumbs')->with('user')->orderBy('thumbs_count','desc')->orderBy('created_at')->paginate();
		return view('home.index.show', ['post' => $post,'comments' => $comment] );
	}
    
}
