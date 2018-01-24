<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    protected $fillable = ['name'];
    public function posts() {
   		return $this->belongsToMany('App\Models\Post');
   	}	

   	static public  function addTag($tag) {
   		$tagStr = str_replace([" ", ',', '，'], '|' , $tag) ;
   		$tags = array_filter(explode('|', $tagStr));
   		foreach($tags as $tag)
   		{
   			$tagid[] = static::firstOrCreate(['name' => $tag])->id;
   		}

   		return $tagid ;
   	}
}
