@extends('admin.layouts.admin')

@section('nav')

@endsection
@section('content')
   <form action="{{route('user.permstore')}}" method="post" class="form form-horizontal">
   	    <div class="row cl">
   	    	<label class="form-label col-md-1 col-md-offset-1">用户名</label>
   	    	<div class="formControls col-md-3">
   	    		<input type="text" class="input-text" name="name"  value="{{$user->name}}">
   	    	</div>	
   	    </div>	
          <div class="cl row">
             @foreach($permissions as $group)
                 <label class="form-label col-md-1"></label>
                 @foreach($group as $row)
                        <input @if($user->hasPermissionTo($row->name)) checked="checked"  @endif type="checkbox" name="perm[]" 
						 value="{{$row->name}}">{{$row->label}} 
                 @endforeach

             @endforeach

          </div>  
        <div class="row cl">
   	    	<label class="form-label col-md-1 col-md-offset-1"></label>
   	    	<div class="formControls col-md-3">
   	    		{{csrf_field()}}
				<input type="hidden" name="id" value="{{$user->id}}">
   	    		<input type="submit"  value="确定" class="btn btn-default">
   	    		
   	    	</div>	
   	    </div>
   </form>
	

@endsection