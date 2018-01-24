@section('css')
    <link href="{{ asset('css/cropper.css') }}" rel="stylesheet" />
@endsection
@include('home.common.header')

<div class="container">
	<div class="row">
		<div class="col-md-2">
            @include('home.common.userside')
        </div>  

        <div class="col-md-10">
         @yield('content')
        </div>	  
    </div>
    

</div>

@section('js')	
    <script src="{{asset('js/cropper.js')}}"></script>
@endsection
@include('home.common.footer')
@yield('js')

