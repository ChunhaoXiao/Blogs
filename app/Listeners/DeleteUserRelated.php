<?php

namespace App\Listeners;

use App\Events\UserDeleted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Storage ;

class DeleteUserRelated
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
     * @param  UserDeleted  $event
     * @return void
     */
    public function handle(UserDeleted $event)
    {
        $event->user->comments()->delete();
        $event->user->thumbs()->delete();
        if($event->user->avatar)
        {
            if(Storage::disk('local')->exists('/avatar/'.$event->user->avatar))
            {
                Storage::delete('/avatar/'.$event->user->avatar);
            }    
        }    
    }
}
