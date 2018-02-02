<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Post ;
use Auth ;
use App\Models\User ;
use App\Models\Comment ;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('wordfilter')->only('store');
        $this->middleware('auth');
    }
    
    //保存评论
    public function store(Request $request, Post $post)
    {
    	$data = $this->validate($request, [
    		'content' => 'required|max:300'
    	]);
        $post->comments()->save(Comment::addComments($request));
        return response()->json(['msg' => '评论成功']);
    }
    
    //给评论点赞
    public function thumb(Comment $comment)
    {
        $user = Auth::user();
        if($comment->thumbs()->where('user_id', $user->id)->count())
        {
            $comment->thumbs()->where('user_id', $user->id)->delete();
            return response()->json(['msg'=>'dec'], 200);
        }  
        $comment->thumbs()->create(['user_id' => $user->id]);
        return response()->json(['msg'=>'inc'],200);
    }

    //删除评论
    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);
        $comment->delete();
        return response()->json(['msg' => '删除成功'] , 200);
    }
}
