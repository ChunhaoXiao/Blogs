<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Menu ;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::orderBy('order')->get()->groupBy('group');
        return view('admin.menu.index')->with('menus', $menus);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.menu.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$this->validate($request,[
    		'name' => 'required|unique:menus' ,
    		'url' => 'required|unique:menus',
    		'group' => 'required'
    	]);
    	Menu::create($request->all());
    }  

  
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        return view('admin.menu.create')->with('menu', $menu);
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
    	$menu = Menu::findOrFail($id);
        $this->validate($request,[
    		'name' => 'required',
    		//'url' => 'required|unique:menus,'.$menu->id,一开启这个验证就报错
    		'group' => 'required'
    	]);
    	$menu->fill($request->all())->save();
    	return redirect(route('menus.index'));

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = Menu::findOrfail($id);
        $menu->delete();
        return response()->json(['success' => '删除成功'], 200);
    }
}


