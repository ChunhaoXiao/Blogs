<?php
namespace App\Services;
class MenuServices{
	function getMenu()
	{
		return  \App\Models\Menu::orderBy('order')->get()->groupBy('group') ;

	}
}