@extends('admin.layouts.admin')

@section('nav')

@endsection
@section('content')
   <form action=" @isset($role) {{route('roles.update',$role)}} @else {{route('roles.store')}} @endisset" method="post" class="form form-horizontal">
   	    <div class="row cl">
   	    	<label class="form-label col-md-1 col-md-offset-1">角色名称</label>
   	    	<div class="formControls col-md-3">
   	    		<input type="text" class="input-text" name="name" value="{{$role->name or ''}}">
   	    	</div>	
   	    </div>	
		
		<div class="cl row">
		    <label class="form-label col-md-1  col-md-offset-1">角色权限</label>
			
			@foreach($permissions as $key => $group)
			 <div>
			     <label class="col-md-1">{{$key}}:</label>
			    
				
					@foreach($group as $row)
						<label class="checkbox-inline">
							<input @isset($role) @if($role->hasPermissionTo($row->name)) checked @endif @endisset name="permission[]" type="checkbox" id="inlineCheckbox1" value="{{$row->name}}"> {{$row->label}}
						</label> 
					@endforeach
			   
			</div>
			
			@endforeach
         @isset($role)
             {{ method_field('PUT') }}
         @endisset
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