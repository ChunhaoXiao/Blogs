@include('home.common.header')
@yield('css')
<div class="container">
    <div class="row">
	    <div class="col-md-9">
		    @yield('content')
		</div>
		<div class="col-md-3">
			<p>
		    @include('home.common.rightside')
		    </p>
		</div>
	</div>
    
</div>
@include('home.common.footer')
@yield('js')
