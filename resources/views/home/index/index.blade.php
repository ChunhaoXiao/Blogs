@extends('home.layouts.home');
@section('content')
@foreach($data as $article)
        <div class="blog-main">
        	<div class="heading-blog"><a href="{{route('indexes.show',$article)}}">{{$article->title}}</a></div>
        	@if($article->pics->count()>0) <img src="{{ asset('storage/'.$article->pics->first()->pic_path) }}"> @endif

        </div>	
        <div class="blog-info">
            <span class="label label-primary">发布时间: {{$article->created_at}}</span>
            <span class="label label-success">所属分类: <a href="{{route('indexes.index',['category'=>$article->category->id])}}">{{$article->category->name}}</a></span>
            <!-- <span class="label label-danger">By Jhon</span>
            <span class="label label-info">
                <i class="fa fa-thumbs-up"></i>+ 10
                <i class="fa fa-thumbs-down"></i>-3
            </span> -->
        </div>
        <div class="blog-txt">
        	{{str_limit(strip_tags($article->body),200,'......')}}
        </div>	
    @endforeach  
    {{$data->links()}}  

@endsection