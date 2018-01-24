<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tag ;
class TagController extends Controller
{
    //
    public function index()
    {
    	$tag = Tag::where(function($query){return  request('word') ? $query->where('name','like','%'.request('word').'%'):$query ;})->
    	withCount('posts')->orderBy('posts_count')->paginate(20);
    	return view('admin.post.tag',['tags' => $tag]) ;
    }

    public function edit(Tag $tag)
    {

    }

    public function forbid(Tag $tag)
    {
    	$tag->forbidden = 1;
    	$tag->save();
    	return redirect(route('tags.index'));
    }

    public function destroy(Tag $tag)
    {
    	
        $tag->posts()->detach();
        $tag->delete();
    	//return redirect(route('tags.index'));
        return response()->json(['success' => '删除成功'] ,200);
    }
}
