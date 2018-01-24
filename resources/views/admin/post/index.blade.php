@extends('admin.layouts.admin')
@section('content')
		<article class="cl pd-20">
			<div class="text-c">
				<span class="select-box inline">
			<form action="{{route('posts.index')}}">		
				<select name="category" class="select">
					<option value=''>全部分类</option>
					<!--<option value="1">分类一</option>
					<option value="2">分类二</option> -->
					@foreach($categories as $category)
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
				
				<a class="btn btn-primary radius" data-title="添加文章" _href="article-add.html"  href="{{route('posts.create')}}"><i class="Hui-iconfont">&#xe600;</i> 添加文章</a>
				</span>
				<span class="r">共有数据：<strong>{{$posts->count()}}</strong> 条</span>
			</div>
			
			<div class="mt-20">

				<table class="table table-border table-bordered table-bg table-hover table-sort">
					<thead>
						<tr class="text-c">
							<th width="25"><input type="checkbox" name="" value=""></th>
							<th width="80">ID</th>
							<th>标题</th>
							<th width="80">分类</th>
							<th width="120">作者</th>
							<th width="120" class="sorting_asc">
								发布时间  
								@if(request('orderby') == 'created_at@desc' || strpos(request('orderby'),'created_at') === false) 
								<a href="{{route('posts.index',['orderby'=>'created_at@asc'])}}">↑</a> @endif 
								@if(request('orderby') == 'created_at@asc' || strpos(request('orderby'),'created_at') === false) 
								<a href="{{route('posts.index',['orderby'=>'created_at@desc'])}}">↓</a>@endif

								
							</th>
							<th width="75">浏览次数</th>
							<th width="75">
								评论数 
								@if(request('orderby') == 'replies@desc' || strpos(request('orderby'),'replies') === false) 
								    <a href="{{route('posts.index',['orderby'=>'replies@asc'])}}">↑</a>
								 @endif
								@if(request('orderby') == 'replies@asc' || strpos(request('orderby'),'replies') === false) 
								    <a href="{{route('posts.index',['orderby'=>'replies@desc'])}}">↓</a>
								@endif
							</th>
							<th width="120">
							    最新回复
							    @if(request('orderby') == 'last_replied@desc' || strpos(request('orderby'),'last_replied') === false) 
								    <a href="{{route('posts.index',['orderby'=>'last_replied@asc'])}}">↑</a>
								 @endif
								@if(request('orderby') == 'last_replied@asc' || strpos(request('orderby'),'last_replied') === false) 
								    <a href="{{route('posts.index',['orderby'=>'last_replied@desc'])}}">↓</a>
								@endif
							</th>
							<th width="120">操作</th>
						</tr>
					</thead>
					<tbody>
						@foreach($posts as $post)
						<tr class="text-c">
							<td><input type="checkbox" value="" name=""></td>
							<td>{{$post->id}}</td>
							<td class="text-l"><b style="cursor:pointer" class="text-primary" onClick="article_edit('查看','article-zhang.html','10001')" title="查看"><a href="{{route('indexes.show',$post)}}" target="_blank">{{str_limit($post->title,30,'...')}}</a></b></td>
							<td><a href="{{route('posts.index',['category'=>$post->category->id])}}">{{$post->category->name}}</a></td>
							<td>{{$post->user->name}}</td>
							<td>{{$post->created_at}}</td>
							<td>{{$post->views}}</td>
							<td>{{$post->comments_count}}</td>
							<td>{{$post->last_replied}}</td>
							
							<td class="f-14 td-manage">
								@if($post->trashed())
									<a class="label label-success" href="{{route('posts.restore', $post)}}">恢复</a>
									<a class="label label-danger" onclick="event.preventDefault();document.getElementById('post_{{$post->id}}').submit();" href="#">彻底删除</a>
									<form id="post_{{$post->id}}" action="{{ route('posts.forcedelete',$post) }}" method="post">
										{{ csrf_field() }}
										{{ method_field('DELETE') }}
									</form>
								@else
									<!-- <a style="text-decoration:none" onClick="article_stop(this,'10001')" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6de;</i></a> -->
									<a style="text-decoration:none" class="ml-5" onClick="article_edit('资讯编辑','article-add.html','10001')" href="{{route('posts.edit',$post)}}" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>
									<a style="text-decoration:none" onclick="event.preventDefault();document.getElementById('post_{{$post->id}}').submit();" class="ml-5" data-type="delete" data-url="{{route('posts.destroy',$post)}}"  href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a>
									
								@endif
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