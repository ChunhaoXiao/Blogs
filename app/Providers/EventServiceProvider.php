<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
/*use App\Models\Post;
use Observers\PostObserver ;*/
class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Event' => [
            'App\Listeners\EventListener',
        ],

        //文章发布后 把文章里面的图片地址保存到数据库
        'App\Events\PostSaved' => [
            'App\Listeners\SavePics',
        ] ,

        'App\Events\PostDeleted' => [
            'App\Listeners\DeletePostRelation',
        ],
        'Illuminate\Auth\Events\Login' => [
            'App\Listeners\SaveLoginData',
        ],
        'App\Events\CommentCreated' => [
            'App\Listeners\SendNotice',
        ],
        'App\Events\UserDeleted' => [
            'App\Listeners\DeleteUserRelated',
        ],

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        //Post::observe(PostObserver::class);

        //
    }
}
