<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CommentReplied extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    protected $comment ;
    public function __construct($comment)
    {
        $this->comment = $comment ;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        //return ['mail'];
        return ['database'] ;
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    /*public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }*/

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */

    public function toDatabase($notifiable)
    {   //这个返回的数组会被转换成json格式 保存到数据库的data字段中
    	return [
    		'reply_time' => time(),
            'content' => $this->comment->user->name.' 回复了你 '.$this->comment->content . " <a href=".route('indexes.show',['post'=>$this->comment->post_id]).">查看</a>" ,
    	];
    }

    /*public function toArray($notifiable)
    {
        return [
            'reply_time' => time(),
            'content' => $this->comment->user->name.' 回复了你 '.$this->comment->content . " <a href=".route('indexes.show',['post'=>$this->comment->post_id]).">
            查看</a>" ,            
        ];
    }*/

   /* public function toMail($notifiable)
    {
        return (new MailMessage)
                ->line('One of your invoices has been paid!')
                ->action('View Invoice', $url)
                ->line('Thank you for using our application!');
    }*/

}
