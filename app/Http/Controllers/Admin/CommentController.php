<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;

class CommentController extends Controller
{
    //
    function __construct() {
        $this->middleware('checkmanager');
    }
    
    public function index(Request $request)
    {
    	$comments = Comment::Filter($request)->with(['post','user'])->orderBy('created_at','desc')->paginate();
    	return view('admin.post.comment',['comments' => $comments]);
    }

     function destroy(Comment $comment)
    {
    	$comment->delete();
        //删除该评论的点赞
        $comment->thumbs()->delete();
        return response()->json(['success'=>'删除成功'], 200);
    }
}
