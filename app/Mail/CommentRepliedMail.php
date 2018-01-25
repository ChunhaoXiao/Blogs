<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Comment ;

class CommentRepliedMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $comment;
    public $origin ;
    public function __construct(Comment $comment, Comment $origin)
    {
        $this->comment = $comment;
        $this->origin = $origin;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.comment')->subject('您的评论被回复');
    }
}
