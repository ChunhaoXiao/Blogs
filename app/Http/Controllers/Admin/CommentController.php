<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;

class CommentController extends Controller
{
    //
    public function index(Request $request)
    {
    	$comments = Comment::where(function($query) use($request){
    		if($keywords = $request->keywords){
    			return $query->where('content','like','%'.$keywords.'%');
    		}
    		if($post_id = $request->post_id){
    			return $query->where('post_id', $post_id);
    		}
    	})->with(['post','user'])->orderBy('created_at','desc')->paginate();
    	return view('admin.post.comment',['comments' => $comments]);
    }

     function destroy(Comment $comment)
    {
    	$comment->delete();
        //删除该评论的点赞
        $comment->thumbs()->delete();
    	//return redirect(route('comments.index'));
        return response()->json(['success'=>'删除成功'], 200);
    }
}
