@extends('admin.layouts.admin')
@section('content')
    <form  action=" @isset($user) {{route('users.update',$user)}} @else {{route('users.store')}} @endisset"  method="post" class="form form-horizontal">
		<div class="row cl">
 	    	<label class="form-label col-md-1 col-md-offset-1">邮箱</label>
 	    	<div class="formControls col-md-3">
 	    		<input type="text" class="input-text" name="email" @isset($user) disabled="disabled" @endisset value="{{$user->email or ''}}">
 	    	</div>	
   	</div>	

    <div class="row cl">
        <label class="form-label col-md-1 col-md-offset-1">用户名</label>
        <div class="formControls col-md-3">
          <input type="text" class="input-text" name="name" value="{{$user->name or ''}}">
        </div>  
    </div>
		<div class="row cl">
 	    	<label class="form-label col-md-1 col-md-offset-1">密码</label>
 	    	<div class="formControls col-md-3">
 	    		<input type="text" class="input-text" name="password">
 	    	</div>	
   	</div>	
	   @isset($user)
     <div class="row cl">
          <label class="form-label col-md-1 col-md-offset-1">禁止用户</label>
           <div class="formControls col-md-3">
            <input type="checkbox" @isset($user->forbid['comment']) checked @endisset name="forbid[comment]" value="comment">禁止发言
            <input type="checkbox" @isset($user->forbid['access']) checked @endisset name="forbid[access]" value="access">禁止访问
           </div>

     </div>
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