<?php
namespace App\Observers;
use App\Models\Post;
use App\Models\Tag ;
use Illuminate\Support\Facades\Storage ;
class PostObserver
{
	/*public function created(Post $post) {

	}*/

    public function saved(Post $post)
    {
    	//更新文章的tag
    	if(request('tag'))
    	{
    		$tags = Tag::addTag(request('tag'));
    		$post->tags()->sync($tags);
    	}
    	
    	//文章图片

    	if($pics = $post->pics)
    	{
    		foreach($pics as $pic)
    		{
    			if(strpos($post->body, basename($pic->pic_path)) === false)
    			{
    				$pic->delete();
    				Storage::delete($pic->pic_path);
    			}	
    		}
    	}

    	if($files = request()->session()->get('file'))
    	{
    		foreach(explode('##', $files) as $file)
    		{
    			$data[] = ['pic_path' => $file];
    		}	
    		$post->pics()->createMany($data);
            request()->session()->forget('file');
    	}
    }

    //删除文章事件
    public function deleted(Post $post)
    {
    	if($post->isForceDeleting())
    	{    //删除和文章相关的图片
    		if($files = $post->pics)
            {
                foreach($files as $file)
	            {
	                if(Storage::disk('local')->exists($file->pic_path))
	                {
	                    Storage::delete($file->pic_path);
	                }
	            }
	            $post->pics()->delete();
            }    
        
            //删除文章的tag关联
            $post->tags()->detach();

	        //删除文章评论
	        $post->comments()->delete();
    	}
    }
} 