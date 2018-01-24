@extends('admin.layouts.admin')
@section('content')
<form action="{{ route('configs.store') }}" method="post" enctype="multipart/form-data" class="form form-horizontal">
   	    <div class="row cl">
   	    	<label class="form-label col-md-2 col-md-offset-1">分页条数</label>
   	    	<div class="formControls col-md-3">
   	    		<input type="text" class="input-text" name="name[perpage]" value="{{$data['perpage']}}">
   	    	</div>	
   	    </div>	
          
   	    <div class="row cl">
   	    	<label class="form-label col-md-2 col-md-offset-1">是否允许评论</label>
   	    	<div class="radio-box">
   	    		<input type="radio" @if($data['allowcomment']) checked @endif name="name[allowcomment]" value=1>是
            </div>
            <div class="radio-box">   
               <input type="radio"  name="name[allowcomment]" @if($data['allowcomment'] == 0) checked @endif value=0>否
   	    	</div>	
   	    </div>	

   	    <div class="row cl">
   	    	<label class="form-label col-md-2 col-md-offset-1">通知方式</label>
   	    	<div class="radio-box">
   	    		<input type="radio"  name="name[notice]" @if($data['notice']=='msg') checked @endif value="msg">消息
            </div>
            <div class="radio-box">  
               <input type="radio"  name="name[notice]" @if($data['notice']=='email') checked @endif value="email">邮件
   	    	</div>	
   	    </div>
          <div class="row cl">
            <label class="form-label col-md-2 col-md-offset-1">IP过滤</label>
            <div class="formControls col-md-3">
               <textarea  class="textarea" name="name[ipfilter]">{{$data['ipfilter']}}</textarea>
            </div>   

          </div>	

   	    <div class="row cl">
   	    	<label class="form-label col-md-2 col-md-offset-1">词语过滤</label>
   	    	<div class="formControls col-md-3">
   	    		<textarea class="textarea" name="name[wordfilter]">{{$data['wordfilter']}}</textarea>
   	    	</div>	
   	    </div>	
   	    
   	  
		<input type="hidden" name="group" value="other">
		
			
			
         
		
        <div class="row cl">
   	    	<label class="form-label col-md-2 col-md-offset-1"></label>
   	    	<div class="formControls col-md-3">
   	    		{{csrf_field()}}
   	    		<input type="submit"  value="确定" class="btn btn-default">
   	    		
   	    	</div>	
   	    </div>
   </form>
@endsection   