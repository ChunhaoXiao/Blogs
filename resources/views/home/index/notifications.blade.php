@extends('home.layouts.home')
@section('content')
    <ul>
    	@foreach($data as $v)
             <li>{!!$v['data']['content']!!} <li>
    	@endforeach

    </ul>
@endsection