<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Observers\PostObserver ;
use App\Models\Post ;
use App\Models\Config;

use View;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Post::observe(PostObserver::class);
        
        View::composer('home.common.rightside', function ($view) {
            //评论最多的文章
            $view->with('most_comments', Post::withCount('comments')->orderBy('comments_count','desc')->limit(5)->get());
            //热门标签
            $view->with('hot_tags',\App\Models\Tag::has('posts',">",0)->withCount('posts')->orderBy('posts_count','desc')->limit(10)->get());


        });
        View::composer('home.index.show', function($view){

            //dump(request()->post);
            $post = request()->post ;

            $tags = $post->tags->pluck('id')->toArray() ;
            $related = $post->whereHas('tags', function($query) use($tags){ 
            $query->whereIn('tags.id',$tags);})->where('id','<>',$post->id)->orderBy('created_at','desc')->limit(5)->get();
            //dump($related);
            $view->with('related', $related);
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
