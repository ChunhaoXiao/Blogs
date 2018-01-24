<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pic extends Model
{
    //
    protected $fillable = ['post_id','pic_path'];
    public function post() {
    	return $this->belongsTo('App\Models\Post');
    }
}
