@extends('home.layouts.user')

@section('content')
<div class="container">
    <form class="form-horizontal" action="{{ route('user.storepass') }}" method="post">
    	<div class="form-group">
    		<label class="control-label col-md-1">原密码</label>
    		<div class="col-md-3">
    			<input type="password" class="form-control" name="oldpassword">
    		</div>	
    	</div>	
    	<div class="form-group">
    		<label class="control-label col-md-1">新密码</label>
    		<div class="col-md-3">
    			<input type="password" class="form-control" name="newpassword">
    		</div>	
    	</div>	
    	<div class="form-group">
    		<label class="control-label col-md-1">新密码</label>
    		<div class="col-md-3">
    			<input type="password" class="form-control" name="newpassword_confirmation">
    		</div>	
    	</div>	
    	{{csrf_field()}}
    	<div class="form-group">
    		<label class="control-label col-md-1"></label>
    		<div class="col-md-3">
    			<input type="submit" class="btn btn-default"  value="确定">
    		</div>	
    	</div>	
    </form>	
</div>
@endsection