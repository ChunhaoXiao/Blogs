<?php

namespace App\Listeners;

use App\Events\PostSaved;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request ;
use Illuminate\Support\Facades\Storage;

class SavePics
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public  $request ;
    public function __construct(Request $request)
    {
        //
        $this->request = $request ;
    }

    /**
     * Handle the event.
     *
     * @param  PostSaved  $event
     * @return void
     */
    public function handle(PostSaved $event)
    {
        if($file = $this->request->session()->get('file')) {
            $files = explode('##', $file);
            foreach($files as $path)
            {
                if(Storage::disk('local')->exists($path))
                {
                    $data[] = ['pic_path' => $path] ;
                }    
            }
            $event->post->pics()->createMany($data);
            $this->request->session()->forget('file');
        }
    }
}
