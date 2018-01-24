<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Image ;
use Storage ;
class UserController extends Controller
{
    //
    public function __construct()
    {
    	$this->middleware('auth');
    }
    public function index()
    {
        $show_fields = [
            'name' => '用户名',
            'email' => '邮件地址',
            'created_at' => '注册时间',
            'last_login_time' => '上次登录时间',
            'last_login_ip' => '上次登录ip',
        ] ;
        $user = auth()->user()->getattributes();
    	return view('home.user.index',compact('show_fields', 'user'));
    }

    public function changePassword()
    {
    	return view('home.user.changePassword');
    }

    public function storePassword(Request $request)
    {
    	$data = $this->validate($request, [
    		'oldpassword' => 'required|min:6' ,
    		'newpassword' => 'required|confirmed|min:6',
    	]);
    	$user = auth()->user() ;
    	if(!Hash::check($data['oldpassword'], $user->password))
    	{
    		return back()->withErrors('原密码错误');
    	}	

    	$user->password = $data['newpassword'];
    	$user->save();
    	return redirect(route('user.index'));
    }

    public function avatar()
    {
        $user = auth()->user();
        return view('home.user.avatar', ['user' => $user]);
    }
    public function storeAvatar(Request $request)
    {
        $this->validate($request,[
            'file' => "required|image|mimes:jpeg,png,jpg|max:2048",
        ]);
        $user = auth()->user() ;
        if($request->file('file')->isValid())
        {
            $userid = $user->id;
            $dirname = ceil($userid/100) ;
            $fileName = $request->file('file')->store('public/avatar/'.$dirname.'/big');
            $baseName = pathinfo($fileName, PATHINFO_BASENAME);
        }

        if($cropped_value = $request->cropped_value)
        {
            $para = explode(',', $cropped_value);
            $image = Image::make($request->file('file')->getRealPath());
            $image->rotate($para[4] * -1);
            $avatar = $image->crop($para[0], $para[1], $para[2], $para[3])->save('storage/avatar/'.$dirname.'/thumb/'.$baseName);
        }
        //dump($image);
        $user->avatar = $dirname.'/thumb/'.$baseName;
        $user->save();
        if($user->avatar)
        {    //删除旧头像文件
            /*if(Storage::disk('local')->exists($user->avatar))
            {
                //
            }  */ 
        }
        //$user->avatar = 
        return response()->json(['success' => 'ok'], 200);    


        //return response()->json(['data' =>$request->cropped_value],200);
    }
}

