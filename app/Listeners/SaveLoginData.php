<?php

namespace App\Listeners;

//use App\Events\AdminLogined;
use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;


use Carbon\Carbon ;

class SaveLoginData
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
     * @param  AdminLogined  $event
     * @return void
     */
    public function handle(login $event)
    {
         $event->user->increment('login_times');
         $event->user->last_login_ip = request()->ip();
         $event->user->last_login_time = Carbon::now();
         $event->user->save();
    }
}
