<?php
use Illuminate\Database\Seeder;
use App\Models\Category ;
use App\Models\User ;
use App\Models\Tag ;
use App\Models\Post ;
class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        if($users->count() < 3)
        {
            $users = factory(App\Models\User::class,3)->create() ;
        }    
        $categories = Category::all();

        if($categories->count() < 5)
        {
            $categories = factory(Category::class,5)->create();
        } 
        //预先添加一些tag,添加文章时关联这些tag，以便在文章显示页面出现 “相关文章” 的效果
        $tags = Tag::all();
        if($tags->count() < 10)
        {
            $tags = factory(App\Models\Tag::class,10)->create();
        }  
        //$tagid = $tags->pluck('id');
        $categories->each(function($cate) use($tags){
            Post::flushEventListeners() ;
            $cate->posts()->saveMany(factory(App\Models\Post::class,2)->make())->each(function($p) use($tags){
                $p->user_id = User::inRandomOrder()->first()->id;
                $p->save() ;
                $p->tags()->attach($tags->random(2)->pluck('id'));
                $p->comments()->saveMany(factory(App\Models\Comment::class,mt_rand(2,9))->make());
            });
        });


        
    }
}
