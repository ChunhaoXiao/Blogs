<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $fillable = ['user_id', 'post_id', 'content', 'reply_to_user', 'reply_to_comment'];
    public function Post()
    {
    	return $this->belongsTo('App\Models\Post')->withDefault();
    }

    public function user()
    {
    	return $this->belongsTo('App\Models\User')->withDefault(['name' => '游客']);
    }

    public function thumbs()
    {
        return $this->morphMany('App\Models\Thumb', 'thumbable');
    }

}
