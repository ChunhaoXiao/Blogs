@extends('admin.layouts.admin')

@section('nav')

@endsection
@section('content')
   <form action="{{route('permissions.update',$permission)}}" method="post" class="form form-horizontal">
   	    <div class="row cl">
   	    	<label class="form-label col-md-1 col-md-offset-1">权限分组</label>
   	    	<div class="formControls col-md-3">
   	    		<input type="text" class="input-text" name="groups" value="{{$permission->groups}}">
   	    	</div>	
   	    </div>	
		<hr />
		<div class="row cl">
   	    	<label class="form-label col-md-1 col-md-offset-1">权限标签</label>
   	    	<div class="formControls col-md-2">
   	    		<input type="text" class="input-text" name="label" value="{{$permission->label}}">
   	    	</div>	
			<label class="form-label col-md-1">权限名称</label>
   	    	<div class="formControls col-md-3">
   	    		<input type="text" class="input-text" name="name" value="{{$permission->name}}">
   	    	</div>	
   	    </div>	
		
        <div class="row cl">
   	    	<label class="form-label col-md-1 col-md-offset-1"></label>
   	    	<div class="formControls col-md-3">
			    {{method_field('PUT')}}
   	    		{{csrf_field()}}
   	    		<input type="submit"  value="确定" class="btn btn-default">
   	    		
   	    	</div>	
   	    </div>
   </form>
	

@endsection