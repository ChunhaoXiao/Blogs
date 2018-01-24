@extends('admin.layouts.admin')

@section('nav')

@endsection
@section('content')
    <form action= "@isset($menu) {{route('menus.update',$menu)}} @else {{route('menus.store')}} @endisset" method="post" class="form form-horizontal">
   	    <div class="row cl">
	       
	       	<label class="form-label col-md-2">菜单分组</label>
	       	<div class="formControls col-md-3">
   	    		<input type="text" class="input-text" value="{{$menu->group or ''}}" name="group">
   	    	</div>
			
	    </div>
   	   <div class="row cl">
	       
	       	<label class="form-label col-md-2">菜单名称</label>
	       	<div class="formControls col-md-3">
   	    		<input type="text" class="input-text" name="name" value="{{ $menu->name or '' }}">
   	    	</div>
			
	    </div>  
	    <div class="row cl">
	       
	       	<label class="form-label col-md-2">菜单url</label>
	       	<div class="formControls col-md-3">
   	    		<input type="text" class="input-text" name="url" value="{{ $menu->url or '' }}">
   	    	</div>
			
	    </div> 
	    <div class="row cl">
	       
	       	<label class="form-label col-md-2">菜单排序</label>
	       	<div class="formControls col-md-3">
   	    		<input class="input-text" name="order" type="number" value="{{ $menu->order or '' }}">
   	    	</div>
			
	    </div> 
	    {{csrf_field()}}
	    @isset($menu)
	        {{method_field('PUT')}}
	    @endisset
	    <div class="row cl">
	    	<label class="form-label col-md-2"></label>
	    	<div class="formControls col-md-3">
	    		<button class="btn btn-primary">确定</button>
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