<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Post ;
use Auth ;
use App\Models\User ;
use App\Models\Comment ;
use App\Notifications\CommentReplied;
use Illuminate\Support\Facades\Mail;
use App\Mail\CommentRepliedMail  ;

class CommentController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('wordfilter')->only('store');
    }
    public function store(Request $request, Post $post)
    {
    	if(!Auth::check())
    	{
            return response()->json(['errors' => '请先登录'],400);
    	}	
    	$data = $this->validate($request, [
    		'content' => 'required|max:300'
    	]);

        //获取回复用户的用户名
        preg_match("/@[^\s]{1,20}/",$request->content,$username);
        isset($username[0]) && $user = User::where('name', trim($username[0], '@'))->first();
    	$data['user_id'] = Auth::user()->id  ;
    	$data['reply_to_comment'] = $request->input('reply_to_comment',0);
        $data['reply_to_user'] = isset($user) ? $user->id : 0 ;
    	$data = $post->comments()->create($data);
        //更新文章最后回复时间
        $data->post->last_replied = \Carbon\Carbon::now();
        $data->post->save();

        if(isset($user))
        {
        	$origin = Comment::find($data->reply_to_comment);
            //发送通知
            $user->notify(new CommentReplied($data));
            //发送邮件
            Mail::to($user)->queue(new CommentRepliedMail($data, $origin));
        }    
        return response()->json(['msg' => '评论成功']);
    }
    
    //评论点赞
    public function thumb(Comment $comment)
    {
        $user = Auth::user();
        if(!$user)
        {
            return response()->json(['msg' => '请登录后点赞'], 400);
        }    
        if(!$comment->thumbs()->where('user_id', $user->id)->first())
        {
            $comment->thumbs()->create([
                'user_id' => auth()->id(),
            ]);
            return response()->json(['msg'=>'inc'],200);
        }  
        else
        {
            $comment->thumbs()->where('user_id', $user->id)->delete();
            return response()->json(['msg'=>'dec'], 200);
        }    
            
    }
}
