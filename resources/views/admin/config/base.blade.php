@extends('admin.layouts.admin')
@section('content')
<form action="{{ route('configs.store') }}" method="post" enctype="multipart/form-data" class="form form-horizontal">
   	    <div class="row cl">
   	    	<label class="form-label col-md-2 col-md-offset-1">网站标题</label>
   	    	<div class="formControls col-md-3">
   	    		<input type="text" class="input-text" name="name[title]" value="{{$data['title']}}">
   	    	</div>	
   	    </div>	
   	    <div class="row cl">
   	    	<label class="form-label col-md-2 col-md-offset-1">描述</label>
   	    	<div class="formControls col-md-3">
   	    		<input type="text" class="input-text" name="name[description]" value=" {{$data['description']}} ">
   	    	</div>	
   	    </div>	
   	    <div class="row cl">
   	    	<label class="form-label col-md-2 col-md-offset-1">关键字</label>
   	    	<div class="formControls col-md-3">
   	    		<input type="text" class="input-text" name="name[keywords]" value=" {{$data['keywords']}} ">
   	    	</div>	
   	    </div>	
   	    <div class="row cl">
   	    	<label class="form-label col-md-2 col-md-offset-1">首页顶部图片</label>
   	    	<div class="formControls col-md-3">
   	    		<input type="file" class="input-text" name="logpic" ">
   	    	</div>	
   	    </div>	
   	    <div class="row cl">
   	    	<label class="form-label col-md-2 col-md-offset-1">页头顶部名字</label>
   	    	<div class="formControls col-md-3">
   	    		<input type="text" class="input-text" name="name[my_name]" value=" {{$data['my_name']}} ">
   	    	</div>	
   	    </div>	
   	    <div class="row cl">
   	    	<label class="form-label col-md-2 col-md-offset-1">名字说明</label>
   	    	<div class="formControls col-md-3">
   	    		<input type="text" class="input-text" name="name[sub_name]" value=" {{$data['sub_name']}} ">
   	    	</div>	
   	    </div>
   	    <div class="row cl">
   	    	<label class="form-label col-md-2 col-md-offset-1">页头个人描述</label>
   	    	<div class="formControls col-md-3">
   	    		<input type="text" class="input-text" name="name[about_me]" value=" {{$data['about_me']}} ">
   	    	</div>	
   	    </div>	
		<input type="hidden" name="group" value="base">
		
			
			
         
		
        <div class="row cl">
   	    	<label class="form-label col-md-2 col-md-offset-1"></label>
   	    	<div class="formControls col-md-3">
   	    		{{csrf_field()}}
   	    		<input type="submit"  value="确定" class="btn btn-default">
   	    		
   	    	</div>	
   	    </div>
   </form>
@endsection   