<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Comment ;

class CommentReplied extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $comment ;
   // public $content ;
    public function __construct(Comment $comment)
    {
        //
        $this->comment = $comment ;
       // $this->content = \App\Models\Comment::find($comm) ;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.comment')->subject('你的评论被回复');
    }
}
