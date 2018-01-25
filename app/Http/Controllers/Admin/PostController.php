<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post ;
use App\Models\Tag ;
use App\Http\Requests\StorePost;
use App\Models\Category ;
use MDEditor ;
use App\Models\User ;
use Auth ;
use App\Events\PostSaved ;
use App\Events\PostDeleted ;
class PostController extends Controller
{
    function __construct() {
        $this->middleware('checkmanager');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $where['ofCate'] = $request->category;
        $where['ofTitle'] = $request->title;
        if($where = array_filter($where,'strlen')){
            foreach($where as $key => $value)
            {
                $query= isset($query) ? $query->$key($value) : Post::$key($value) ;
            }    
        }
        !isset($query) && $query = Post::query() ;
        $orderby = $request->orderby;
        $posts = $query->when($orderby, function($query) use ($orderby){
            list($field, $type) = explode('@', $orderby);
            if(in_array($field, ['created_at', 'updated_at', 'last_replied']))
            {
                $query->orderBy($field, $type) ;
            } 
            elseif($field == 'replies')
            {
                $query->withCount('comments')->orderBy('comments_count',$type);
            }   
            else
            {
                $query->orderBy('global_top','desc')->orderBy('created_at','desc');
            } 
        },
        function($query){
            $query->orderBy('global_top','desc')->orderBy('created_at','desc') ;
        })->with(['category','user'])->withCount('comments')->paginate(20);
        
        $categories = Category::all();
        return view('admin.post.index', ['posts' => $posts,'categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.post.create',['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePost $request)
    {
        $top['category_top'] = $top['global_top'] = $request->top ;
        $data = $request->only(['title','category_id','tag' ,'body']);
        //触发PostObserver里面的saved()方法
        $post = Auth::user()->posts()->create(array_merge($data, $top));
        return redirect(route('posts.index'))->with('status','添加成功');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.post.show',['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('admin.post.edit',['post' => $post, 'categories' => $categories]);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $top['category_top'] = $top['global_top'] = $request->top ;
        $post = Post::findOrFail($id);
        $post->fill($top);
        $post->update($request->all());
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json(['success' => '删除成功'], 200);
    }

    public function upload(Request $request) {
        $files =  $request->file();
        $subdir = date('Ym',time()) ;
        foreach($files as $file) {
            $img = $file->store('upload/'.$subdir.'/');
        }
        $file = $request->session()->get('file');
        $fileArr = $file ? $file.'##'.$img : $img ;
        $request->session()->flash('file', $fileArr); 

        $data['success'] = 1 ;
        $data['message'] = 'ok';
        $data['url'] = asset('storage/'.$img) ;
        return response()->json($data, 200);
    }

    public function restore($id)
    {
        Post::onlyTrashed()->where('id', $id)->restore();
        return response()->json(['success' => '恢复成功'], 200);
    }

    //彻底删除
    public function forceDelete($post)
    {
        $post = Post::onlyTrashed()->find($post);
        $post->forceDelete();
        return response()->json(['success' => '彻底删除成功'], 200);
    }

    //回收站
    public function trashed()
    {

        $trashed = Post::onlyTrashed()->where(function($query){
            if($title = request()->title)
            {
                return $query->where('title','like','%'.$title.'%') ;
            }
            if($category = request()->category)
            {
                return $query->where('category_id', $category);
            }    

        })->withCount('comments')->orderBy('deleted_at','desc')->paginate(20);
        return view('admin.post.trashed')->with('trashed', $trashed);
    }
}
