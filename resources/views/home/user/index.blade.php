@extends('home.layouts.user')
@section('content')
    你好{{auth()->user()->name}}
   <div class="container">
   	    @foreach($show_fields as $key => $field)
   	    <div class="row">
   	    	<label class="col-md-2 text-right ">{{$field}} :</label>
   	    	<div class="col-md-2">{{$user[$key]}}</div>
   	    </div> 
   	    @endforeach

   </div>

@endsection