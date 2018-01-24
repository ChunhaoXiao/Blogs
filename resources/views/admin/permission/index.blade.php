@extends('admin.layouts.admin')
@section('content')
		<article class="cl pd-20">
			<div class="text-c">
				<span class="select-box inline">
				<select name="" class="select">
					<option value="0">全部分类</option>
					<option value="1">分类一</option>
					<option value="2">分类二</option>
				</select>
				</span>
				日期范围：
				<input type="text" onfocus="WdatePicker({maxDate:'#F{$dp.$D(\'logmax\')||\'%y-%M-%d\'}'})" id="logmin" class="input-text Wdate" style="width:120px;">
				-
				<input type="text" onfocus="WdatePicker({minDate:'#F{$dp.$D(\'logmin\')}',maxDate:'%y-%M-%d'})" id="logmax" class="input-text Wdate" style="width:120px;">
				<input type="text" name="" id="" placeholder=" 资讯名称" style="width:250px" class="input-text">
				<button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜资讯</button>
			</div>
			<div class="cl pd-5 bg-1 bk-gray mt-20">
				<span class="l">
				
				<a class="btn btn-primary radius" data-title="添加资讯"  href="{{route('permissions.create')}}"><i class="Hui-iconfont">&#xe600;</i>添加</a>
				</span>
				<span class="r">共有数据：<strong>54</strong> 条</span>
			</div>
			<div class="mt-20">
				<table class="table table-border table-bordered table-bg table-hover table-sort">
					<thead>
						<tr class="text-c">
						
						    <th>分组</th>
							
							<th>ID</th>
							<th>权限标签</th>
							<th >权限名称</th>
						
							<th>操作</th>
						</tr>
					</thead>
					<tbody>
						
					    @foreach($permissions as $key => $group)
							<tr class="text-c">
							
							<td rowspan="{{$group->count()}}">{{$key}}</td>
							
							@foreach($group as $row)
							
							<td>{{$row->id}}</td><td>{{$row->label}}</td><td>{{$row->name}}</td>
							<td><a style="text-decoration:none" class="ml-5" href="{{route('permissions.edit',$row)}}"><i class="Hui-iconfont">&#xe6df;</i></a>
									<a style="text-decoration:none" class="ml-5" onclick="event.preventDefault();
                                                     document.getElementById('{{$row->name}}').submit();"  title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
							</tr><tr class="text-c">
							<form id="{{$row->name}}" action="{{ route('permissions.destroy',$row) }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
											{{method_field('DELETE')}}
                                        </form>
							
							@endforeach
								
						@endforeach

						   
					</tbody>
				</table>
			</div>
		</article>
	@endsection