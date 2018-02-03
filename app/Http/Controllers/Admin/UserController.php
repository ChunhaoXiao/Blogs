<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Validation\Rule;
use Validator ;


class UserController extends Controller
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
        $name = $request->name ;
        $users = User::when($name,function($query) use($name) { $query->where('name', 'like', '%'.$name.'%');})->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.user.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create_and_edit');
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
            'name' => 'required|unique:users|max:30',
            'password' => 'required',
            'email' => 'required|unique:users|email',
        ]);
        User::create($request->only(['name', 'email', 'password']));
        return redirect(route('users.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.user.create_and_edit',['user' => $user]);
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
        $user = User::findOrFail($id);
        $name = $this->validate($request,
        [  
            'name' => ['required', Rule::unique('users')->ignore($user->id)], 
        ]);
        $user->forbid = [] ;
        //只能通过这个赋值方法更新,否则模型的 $casts 属性不能使用
        foreach($request->only(['name', 'password', 'forbid']) as $key => $value)
        {
            if($value)
            {
                $user->$key = $value ;
            }    
        } 
        $user->save() ;
        return redirect(route('users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete() ;
        return response()->json(['success' => '删除成功'], 200);
    }

    public function setPerm(Request $request,User $user) 
    {
        $permissions = Permission::all()->groupBy('groups');
        return view('admin.user.setperm',['user'=>$user,'permissions'=>$permissions]);
    }
    //个人博客 这些不用了
    public function storeUserPerm(Request $request) {
        $perm = $request->input('perm',[]);
        User::find($request->id)->syncPermissions($perm);
    }


}
