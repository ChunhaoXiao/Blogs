@include('admin.common.header')
@include('admin.common.side')

<section class="Hui-article-box">
	<nav class="breadcrumb">@yield('nav')</nav>
	<div class="Hui-article">
        @yield('content')
    </div>    
</section>	
@include('admin.common.footer')