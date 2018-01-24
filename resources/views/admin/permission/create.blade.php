@extends('admin.layouts.admin')

@section('nav')

@endsection
@section('content')
   <form action="{{route('permissions.store')}}" method="post" class="form form-horizontal">
   	    <div class="row cl">
   	    	<label class="form-label col-md-1 col-md-offset-1">权限分组</label>
   	    	<div class="formControls col-md-3">
   	    		<input type="text" class="input-text" name="groups">
   	    	</div>	
   	    </div>	
		<hr />
		<div class="row cl">
   	    	<label class="form-label col-md-1 col-md-offset-1">权限标签</label>
   	    	<div class="formControls col-md-2">
   	    		<input type="text" class="input-text" name="permission[0][label]">
   	    	</div>	
			<label class="form-label col-md-1">权限名称</label>
   	    	<div class="formControls col-md-3">
   	    		<input type="text" class="input-text" name="permission[0][name]">
   	    	</div>	
   	    </div>	
		<div class="row cl">
   	    	<label class="form-label col-md-1 col-md-offset-1">权限标签</label>
   	    	<div class="formControls col-md-2">
   	    		<input type="text" class="input-text" name="permission[1][label]">
   	    	</div>	
			<label class="form-label col-md-1">权限名称</label>
   	    	<div class="formControls col-md-3">
   	    		<input type="text" class="input-text" name="permission[1][name]">
   	    	</div>	
   	    </div>	<div class="row cl">
   	    	<label class="form-label col-md-1 col-md-offset-1">权限标签</label>
   	    	<div class="formControls col-md-2">
   	    		<input type="text" class="input-text" name="permission[2][label]">
   	    	</div>	
			<label class="form-label col-md-1">权限名称</label>
   	    	<div class="formControls col-md-3">
   	    		<input type="text" class="input-text" name="permission[2][name]">
   	    	</div>	
   	    </div>	<div class="row cl">
   	    	<label class="form-label col-md-1 col-md-offset-1">权限标签</label>
   	    	<div class="formControls col-md-2">
   	    		<input type="text" class="input-text" name="permission[3][label]">
   	    	</div>	
			<label class="form-label col-md-1">权限名称</label>
   	    	<div class="formControls col-md-3">
   	    		<input type="text" class="input-text" name="permission[3][name]">
   	    	</div>	
   	    </div>	
        <div class="row cl">
   	    	<label class="form-label col-md-1 col-md-offset-1"></label>
   	    	<div class="formControls col-md-3">
   	    		{{csrf_field()}}
   	    		<input type="submit"  value="确定" class="btn btn-default">
   	    		
   	    	</div>	
   	    </div>
   </form>
	

@endsection