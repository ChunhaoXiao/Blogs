@extends('admin.layouts.admin')
@section('content')
		<article class="cl pd-20">
			
			
			<div class="mt-20">
				<p><a class="btn btn-primary" href="{{route('menus.create')}}">添加菜单</a></p>
				<table class="table table-border table-bordered table-bg table-hover table-sort">
					<thead>
						<tr class="text-c">
						    <th>分组</th>
						    <th>菜单名称</th>
							
							<th>菜单url（路由名）</th>
							
							<th >排序</th>
						
							<th>操作</th>
						</tr>
					</thead>
					<tbody>
						
					    @foreach($menus as $key => $group)
							<tr class="text-c">
							
							<td rowspan="{{$group->count()}}">{{$key}}</td>
							
							@foreach($group as $row)
							
						    <td>{{$row->name}}</td>
						    <td>{{$row->url}}</td>
						    <td>{{$row->order}}</td>
							<td><a style="text-decoration:none" class="ml-5" href="{{route('menus.edit',$row)}}"><i class="Hui-iconfont">&#xe6df;</i></a>
									<a style="text-decoration:none" class="ml-5"  title="删除" data-type="delete" data-url="{{route('menus.destroy',$row)}}"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
							</tr><tr class="text-c">
							
							
							
						    @endforeach		
						@endforeach

						   
					</tbody>
				</table>
			</div>
		</article>
	@endsection
    @section('js')
        <script src="{{asset('/js/ajax.js')}}"></script>
    @endsection