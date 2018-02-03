@extends('admin.layouts.admin')

@section('nav')

@endsection
@section('content')
@include('editor::head')

    <form enctype="multipart/form-data" action= {{route('posts.update',$post)}}  method="post" class="form form-horizontal">
   	    <div class="row cl">
	        <label class="form-label col-md-2">文章分类</label>
	       	<div class="formControls col-md-3">
   	    	 	<select class="select" name="category_id">
   	    	 		@foreach($categories as $category)
   	    	 			<option @if($post->category_id == $category->id) selected @endif value="{{$category->id}}">{{$category->name}}</option>
   	    	 		@endforeach

   	    	 	</select>
   	    	</div>
   	    </div>
   	    <div class="row cl">	
	       	<label class="form-label col-md-2">标题</label>
	       	<div class="formControls col-md-3">
   	    	 	<input type="text" name="title" class="input-text name="group" value="{{$post->title}}">
   	    	</div>
   	    </div>
   	   <div class="row cl">	
			   <label class="form-label col-md-2">标签Tag</label>
	       	<div class="formControls col-md-3">
   	    	 	<input type="text" class="input-text"  name="tag" value="{{ $post->tags->pluck('name')->implode(' ') }}">
   	    	</div>
	      </div>
         <div class="row cl"> 
            <label class="form-label col-md-2">置顶</label>
            <div class="formControls col-md-3">
               <select name="top" class="select">
                  <option  vlaue="0">无</option>
                  <option @if($post->global_top) selected @endif value="global">全局置顶</option>
                  <option @if($post->category_top) selected @endif value="category">分类置顶</option>
               </select>
            </div>
         </div>
   	    <div class="row cl">

   	    	<label class="form-label col-md-2">内容</label>
   	    	
   	    	<div id="mdEditor">
   	    		<textarea  name="body">{{ $post->getAttributes()['body'] }}</textarea>
   	    	</div>
   	    </div>	
	   	{{csrf_field()}}
         {{method_field('PUT')}}
	    <div class="row cl">
	    	<label class="form-label col-md-2"></label>
	    	<div class="formControls col-md-3">
	    		<button type="submit" class="btn btn-primary">确定</button>
	    	</div>
	    </div> 

   </form>
	@if (count($errors) > 0)
	    <div class="alert alert-danger">
	        <ul>
	            @foreach ($errors->all() as $error)
	                <li>{{ $error }}</li>
	            @endforeach
	        </ul>
	    </div>
    @endif

@endsection
@section('js')
  
     
    @include('editor::head')
    
    
@endsection