<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Login ;
class LoginController extends Controller
{
    //
    use AuthenticatesUsers;

    protected $redirectTo = '/admin' ;

    public function __construct()
    {
        $this->middleware('isadmin')->except('adminLogout');
    }

    public function showLoginForm()
    {
    	return view('admin.admin.login');
    }

	public function adminLogout()
	{
		Auth::logout();
		return redirect(route('admin.index'));
	}

    public function dologin(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password]))
        {
            return redirect()->intended('/admin');
        }
        return redirect()->route('admin.login');
    }
}
