<?php
namespace App\Services ;
use App\Models\Category ;
class CategoryServices
{
	function getCategory()
	{
		return Category::withCount('posts')->get();
	}
}