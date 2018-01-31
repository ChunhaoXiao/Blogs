@extends('admin.layouts.admin')

@section('nav')

@endsection
@section('content')


    <form enctype="multipart/form-data" action= {{route('posts.store')}}  method="post" class="form form-horizontal">
   	    <div class="row cl">
	        <label class="form-label col-md-2">文章分类</label>
	       	<div class="formControls col-md-3">
   	    	 	<select class="select" name="category_id">
   	    	 		@foreach($categories as $category)
   	    	 			<option value="{{$category->id}}">{{$category->name}}</option>
   	    	 		@endforeach

   	    	 	</select>
   	    	</div>
   	    </div>
   	    <div class="row cl">	
	       	<label class="form-label col-md-2">标题</label>
	       	<div class="formControls col-md-3">
   	    	 	<input type="text" name="title" class="input-text name="group">
   	    	</div>
   	    </div>
   	   <div class="row cl">	
			   <label class="form-label col-md-2">标签Tag</label>
	       	<div class="formControls col-md-3">
   	    	 	<input type="text" class="input-text"  name="tag">
   	    	</div>
	      </div>
         <div class="row cl"> 
            <label class="form-label col-md-2">置顶</label>
            <div class="formControls col-md-3">
               <select  name="top" class="select">
                  <option vlaue="0">无</option>
                  <option value="global">全局置顶</option>
                  <option value="category">分类置顶</option>
               </select>
            </div>
         </div>
   	    <div class="row cl">



   	    	<label class="form-label col-md-2">内容</label>
   	    	
   	    	<div class="col-md-5 editor">
   	    		<textarea id="myEditor"  name="body"></textarea>
   	    	</div>
   	    </div>	
	   	{{csrf_field()}}
   	    
	    <div class="row cl">
	    	<label class="form-label col-md-2"></label>
	    	<div class="formControls col-md-3">
	    		<button type="submit" class="btn btn-primary">确定</button>
	    	</div>
	    </div> 

   </form>
   @include('error');


@endsection
@section('js')
   <script>
     $(function(){
          $(document).on('click',"button.editormd-enter-btn",function(){
          // alert('sdfsdfsdfsdfsdf');
           //var event = $(this.event).click[0] ;
           //console.log(event) ;
            //return false ;
            alert('ssss');
          })
     });
    
</script>
@include('editor::head')
    
@endsection