@extends('admin.layouts.admin')
@section('content')
		<article class="cl pd-20">
			<div class="text-c">
				<span class="select-box inline">
			<form action="{{route('posts.trashed')}}">	
			@inject('category','App\Services\CategoryServices')	
				<select name="category" class="select">
					<option value=''>全部分类</option>
					@foreach($category->getCategory() as $category)
					    <option value="{{ $category->id }}">{{$category->name}}</option>
					@endforeach
				</select>
				</span>
				
				<input type="text" name="title" id="" placeholder="标题" style="width:250px" class="input-text">
				<button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜索</button>
			</form>	
			</div>
			<div class="cl pd-5 bg-1 bk-gray mt-20">
				<span class="l">
				回收站
				
				</span>
				<span class="r">共有数据：<strong>{{\App\Models\Post::onlyTrashed()->count()}}</strong> 条</span>
			</div>
			<div class="mt-20">
				<table class="table table-border table-bordered table-bg table-hover table-sort">
					<thead>
						<tr class="text-c">
							<th width="25"><input type="checkbox" name="" value=""></th>
							<th width="80">ID</th>
							<th>标题</th>
							<th width="80">分类</th>
							<th width="80">作者</th>
							<th width="120">更新时间</th>
							<th width="75">浏览次数</th>
							<th>评论数</th>
							<th width="120">操作</th>
						</tr>
					</thead>
					<tbody>
						@foreach($trashed as $post)
						<tr class="text-c">
							<td><input type="checkbox" value="" name=""></td>
							<td>{{$post->id}}</td>
							<td class="text-l"><u style="cursor:pointer" class="text-primary" onClick="article_edit('查看','article-zhang.html','10001')" title="查看"><a href="{{route('posts.show',$post)}}">{{$post->title}}</a></u></td>
							<td><a href="{{route('posts.trashed',['category'=>$post->category->id])}}">{{$post->category->name}}</a></td>
							<td></td>
							<td>{{$post->created_at}}</td>
							<td>{{$post->views}}</td>
							<td>{{$post->comments_count}}</td>
							
							<td class="f-14 td-manage">
									<a class="label label-success" data-type="delete" data-request="get" data-url="{{route('posts.restore', $post)}}" href="javascript:;">恢复</a>
									<a class="label label-danger" data-type="delete" data-url="{{ route('posts.forcedelete',$post) }}" href="javascript:;">彻底删除</a>
							</td>
						</tr>
					    @endforeach
					</tbody>
				</table>
			</div>
		</article>
	@endsection
	@section('js')
	    <script src="{{ asset('js/ajax.js') }}"></script>
	@endsection