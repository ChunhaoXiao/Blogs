@extends('admin.layouts.admin')
@section('content')
		<article class="cl pd-20">
			
			<div class="cl pd-5 bg-1 bk-gray mt-20">
				<span class="l">
				
				<a class="btn btn-primary radius" data-title="添加资讯" _href="article-add.html" onclick="article_add('添加资讯','article-add.html')" href="{{route('categories.create')}}"><i class="Hui-iconfont">&#xe600;</i> 添加分类</a>
				</span>
				
			</div>
			<div class="mt-20">
				<table class="table table-border table-bordered table-bg table-hover table-sort">
					<thead>
						<tr class="text-c">
							<th width="25"><input type="checkbox" name="" value=""></th>
							<th width="80">ID</th>
							<th>分类名称</th>
							<th>文章数量</th>
							<!--<th width="80">分类</th>
							<th width="80">来源</th>
							<th width="120">更新时间</th>
							<th width="75">浏览次数</th>
							<th width="60">发布状态</th>-->
							<th width="120">操作</th>
						</tr>
					</thead>
					<tbody>
						@foreach($categories as $cate)
						<tr class="text-c">
							<td><input type="checkbox" value="" name=""></td>
							<td>{{$cate->id}}</td>
							<td class="text-l">{{$cate->name}}</td>
							<td>{{$cate->posts_count}}</td>
							<td class="f-14 td-manage" data-id="{{$cate->id}}">
								<a style="text-decoration:none" class="ml-5"  href="{{route('categories.edit',$cate)}}" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>
								<a style="text-decoration:none" class="ml-5" data-type="delete" onclick="" data-url="{{route('categories.destroy',$cate)}}"  href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a>
                            </td>


								
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