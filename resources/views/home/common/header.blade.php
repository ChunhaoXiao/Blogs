<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="" />
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>{{config('title')}}</title>
    <!-- BOOTSTRAP CORE STYLE CSS -->
    <link href="{{ asset('assets/home/css/bootstrap.css') }}" rel="stylesheet" />
    <!-- FONTAWESOME STYLE CSS -->
    <link href="{{ asset('assets/home/css/font-awesome.css') }}" rel="stylesheet" />
    <!-- CUSTOM STYLE CSS -->
    <link href="{{ asset('assets/home/css/style.css') }}" rel="stylesheet" />
    @yield('css')
</head>
<body>


    <section class="header-section">
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    <a href="{{route('indexes.index')}}"><img src="{{asset('storage/'.config('logpic'))}}" class="img-circle img-responsive" /></a>
                </div>
                <div class="col-md-4 text-center">
                    <h1><strong>{{lcfirst(config('my_name'))}} </strong></h1>
                    <h4>{{config('sub_name')}}</h4>
                </div>
                <div class="col-md-4">
                    <h3>about me:</h3>
                    {{config('about_me')}}
                     <i><strong></strong></i>
                   
                </div>

                <!---->
                <div class="col-md-2">
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">登录</a></li>
                            <li><a href="{{ route('register') }}">注册</a></li>
                        @else
                            <li>@if(auth()->user()->unreadNotifications->count()>0) <a href="{{route('notifications.index')}}">新通知</a> @endif</li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            退出
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                    <li><a href="{{route('user.index')}}">设置</a></li>
                                    
                                </ul>
                                   
                            </li>
                        @endguest
                    </ul>
                </div>
                <!---->

            </div>
        </div>
    </section>
	