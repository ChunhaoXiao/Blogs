<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use LaraMall\Admin\Sysinfo\Facades\Sysinfo ;

class AdminController extends Controller
{    function __construct() {
        $this->middleware('checkmanager');
	}
    
    function index() {

    	return view('admin.admin.index');
    }
}
