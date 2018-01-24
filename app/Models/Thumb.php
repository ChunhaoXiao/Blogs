<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Thumb extends Model
{
    //
    protected $guarded = [];
    public function thumbable()
    {
    	return $this->morphTo();
    }
}
