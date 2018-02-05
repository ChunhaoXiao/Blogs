<?php

namespace App\Listeners;

use App\Events\PostDeleted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Storage ;

class DeletePostRelation
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
     * @param  PostDeleted  $event
     * @return void
     */
    public function handle(PostDeleted $event)
    {
        //删除数据库的图片
        if($files = $event->post->pics)
        {
            foreach($files as $file)
            {
                if(Storage::disk('local')->exists($file->pic_path))
                {
                    Storage::delete($file->pic_path);
                }
            }
            $event->post->pics()->delete();
        }    
        
        //删除文章的tag关联
        $event->post->tags()->detach();

        //删除文章评论
        $event->post->comments()->delete();
    }
}
