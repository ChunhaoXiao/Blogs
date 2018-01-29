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

	//文章列表页
	public function index(Request $request) 
	{   
		$perpage = config('perpage') ? config('perpage'): 5 ;
		$query = Post::ofFilter($request);
		$posts = $query->with(['pics','category'])->orderBy('global_top','desc')->orderBy('created_at','desc')->paginate($perpage);
		return view('home.index.index',['data' => $posts]);
	}

    //文章详情页
	public function show(Post $post) {
		$comment = $post->comments()->withCount('thumbs')->with('user')->orderBy('thumbs_count','desc')->orderBy('created_at')->paginate(20);
		return view('home.index.show', ['post' => $post,'comments' => $comment] );
	}
    
}
