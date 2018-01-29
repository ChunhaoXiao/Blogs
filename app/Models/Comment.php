<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Events\CommentCreated ;

class Comment extends Model
{
    //
    protected $fillable = ['user_id', 'post_id', 'content', 'reply_to_user', 'reply_to_comment'];
    protected $dispatchesEvents = [
        'created' => CommentCreated::class,
    ];
    public function Post()
    {
    	return $this->belongsTo('App\Models\Post')->withDefault();
    }

    public function user()
    {
    	return $this->belongsTo('App\Models\User')->withDefault(['name' => '游客']);
    }

    public function thumbs()
    {
        return $this->morphMany('App\Models\Thumb', 'thumbable');
    }

    static function addComments($request)
    {
        preg_match("/@[^\s]{1,20}/", $request->content, $username);
        if(isset($username[0]))
        {
            $user = \App\Models\User::where('name', trim($username[0], '@'))->first();
        } 
        $comment = new static ; 
        $comment->user_id = $request->user()->id ;
        $comment->reply_to_comment = $request->reply_to_comment ? $request->reply_to_comment : 0 ;
        $comment->reply_to_user = isset($user) ? $user->id : 0 ;
        $comment->content = $request->content;
        return $comment ;
    }

}
