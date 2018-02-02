<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use EndaEditor ;

class Post extends Model
{
    //
    use SoftDeletes ;

    protected $fillable = ['title','body','user_id','category_id','views','global_top','category_top'];

    public function setGlobalTopAttribute($value)
    {
    	$this->attributes['global_top'] = $value == 'global' ? 1 : 0 ;
    }

    public function setCategoryTopAttribute($value)
    {
    	$this->attributes['category_top'] = $value == 'category' ? 1 : 0 ;
    }

    public function tags() {
    	return $this->belongsToMany('App\Models\Tag');
    }

	public function category() {
	    return $this->belongsTo('App\Models\Category')->withDefault(['name' => '未分类','id' => 0]);
	}

	public function comments()
	{
		return $this->hasMany('App\Models\Comment');
	}
	public function thumbs()
	{
		return $this->morphMany('App\Models\Thumb', 'thumbable');
	}

	public function getBodyAttribute($value) {
	    return EndaEditor::MarkDecode($value);
	}

	public function pics()
	{
		return $this->hasMany('App\Models\Pic');
	}

    public function user()
    {
    	return $this->belongsTo('App\Models\User');
    }

    public function scopeOfFilter($query, $request)
    {
        if($request->category)
        {
            $query = $query->where('category_id', $request->category);
        } 
        if($request->content)
        {
            $qeury = $query->where('title', 'like', '%'.$request->content.'%')->orWhere('body', 'like', '%'.$request->content.'%');
        }  
        if($request->tag)
        {
            $query = \App\Models\Tag::where('name', $request->tag)->first()->posts();
        } 
        return $query ; 
    }
    
    public function scopeOrder($query, $request)
    {
        $orderby = $request->orderby;
        $query = $query->when($orderby, function($query) use ($orderby){
            list($field, $type) = explode('@', $orderby);
            if(in_array($field, ['created_at', 'updated_at', 'last_replied']))
            {
               return  $query->orderBy($field, $type) ;
            } 
            elseif($field == 'replies')
            {
               return  $query->withCount('comments')->orderBy('comments_count',$type);
            }   
            else
            {
               return  $query->orderBy('global_top','desc')->orderBy('created_at','desc');
            } 
        },
        function($query){
            return $query->orderBy('global_top','desc')->orderBy('created_at','desc') ;
        });
        return $query ;
    }
}
