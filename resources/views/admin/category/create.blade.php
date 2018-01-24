@extends('admin.layouts.admin')

@section('nav')

@endsection
@section('content')
   <form action=" @isset($category) {{route('categories.update',$category)}} @else {{route('categories.store')}} @endisset" method="post" class="form form-horizontal">
   	    <div class="row cl">
   	    	<label class="form-label col-md-1 col-md-offset-1">分类名称</label>
   	    	<div class="formControls col-md-3">
   	    		<input type="text" class="input-text" name="name" value="{{$category->name or ''}}">
   	    	</div>	
   	    </div>	
         @isset($category)
             {{ method_field('PUT') }}
         @endisset
		
        <div class="row cl">
   	    	<label class="form-label col-md-1 col-md-offset-1"></label>
   	    	<div class="formControls col-md-3">
   	    		{{csrf_field()}}
   	    		<input type="submit"  value="确定" class="btn btn-default">
   	    		
   	    	</div>	
   	    </div>
   </form>
	

@endsection