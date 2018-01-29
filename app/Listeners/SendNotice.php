<?php

namespace App\Listeners;

use App\Events\CommentCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\CommentReplied;
use Illuminate\Support\Facades\Mail;
use App\Mail\CommentRepliedMail  ;

class SendNotice
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CommentCreated  $event
     * @return void
     */
    public function handle(CommentCreated $event)
    {
        $event->comment->post->update(['last_replied' => \Carbon\Carbon::now()]);
        if($event->comment->reply_to_user)
        {
            $user = \App\Models\User::find($event->comment->reply_to_user);
            //发送通知
            $user->notify(new CommentReplied($event->comment));
            //发送邮件
            $origin = \App\Models\Comment::find($event->comment->reply_to_comment);
            Mail::to($user)->queue(new CommentRepliedMail($event->comment, $origin));
        }    

    }
}
