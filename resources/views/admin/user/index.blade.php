@extends('admin.layouts.admin')
@section('content')
		<article class="cl pd-20">
			<div class="text-c">
				<!-- <span class="select-box inline">
				<select name="" class="select">
					<option value="0">全部分类</option>
					<option value="1">分类一</option>
					<option value="2">分类二</option>
				</select>
				</span>
				日期范围：
				<input type="text" onfocus="WdatePicker({maxDate:'#F{$dp.$D(\'logmax\')||\'%y-%M-%d\'}'})" id="logmin" class="input-text Wdate" style="width:120px;">
				-
				<input type="text" onfocus="WdatePicker({minDate:'#F{$dp.$D(\'logmin\')}',maxDate:'%y-%M-%d'})" id="logmax" class="input-text Wdate" style="width:120px;"> -->
				<form method="get" action="{{route('users.index')}}">
					<input type="text" name="name" id="" placeholder="用户名" style="width:250px" class="input-text" value="{{request('name')}}">
					<button  class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i>搜索</button>
			    </form>
			</div>
			<div class="cl pd-5 bg-1 bk-gray mt-20">
				<span class="l">
				
				<a class="btn btn-primary radius" data-title="添加资讯"  href="{{route('users.create')}}"><i class="Hui-iconfont">&#xe600;</i>添加用户</a>
				</span>
				<span class="r">共有数据：<strong>{{\App\Models\User::count()}} </strong> 条</span>
			</div>
			<div class="mt-20">
				<table class="table table-border table-bordered table-bg table-hover table-sort">
					<thead>
						<tr class="text-c">
							<th><input type="checkbox" name="" value=""></th>
							<th>ID</th>
							<th>用户名</th>
							<th >邮箱</th>
							
							<th>注册时间</th>
							
							<th>操作</th>
						</tr>
					</thead>
					<tbody>
						
					    @foreach($users as $user)
							<tr class="text-c">
								<td><input type="checkbox" value="" name=""></td>
								<td>{{$user->id}}</td>
								<td>{{$user->name}}</td>
								<td >{{$user->email}}</td>
								<td>{{$user->created_at}}</td>
								<td class="f-14 td-manage">
								    <!-- <a class="btn btn-primary radius"  href="{{route('user.setperm',['user'=>$user])}}"><i class="Hui-iconfont">编辑权限</a></a> -->
									<a style="text-decoration:none" class="ml-5" href="{{route('users.edit',$user)}}"><i class="Hui-iconfont">&#xe6df;</i></a>
									<a style="text-decoration:none" class="ml-5" data-type="delete"  data-url="{{ route('users.destroy',$user) }}" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
							</tr>
						@endforeach

						   
					</tbody>
				</table>
			</div>
		</article>
	@endsection
	@section('js')
		<script src="{{asset('/js/ajax.js')}}"></script>
	@endsection