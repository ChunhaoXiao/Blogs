<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth ;

class NotificationsController extends Controller
{
    //
    public function __construct()
    {
    	$this->middleware('auth');
    }
    public function index()
    {
    	$notifications = Auth::user()->unreadNotifications->each(function($item){
            $item->markAsRead();
        })->toArray();
    	//dd($notifications);
    	return view('home.index.notifications', ['data'=>$notifications]); 
    }
}
