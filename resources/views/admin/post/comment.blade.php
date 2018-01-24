@extends('admin.layouts.admin')
@section('content')
		<article class="cl pd-20">
			<div class="text-c">
				<span class="select-box inline">
			<form action="{{route('comments.index')}}">		
				
				</span>
				
				<input type="text" name="keywords" id="" placeholder="关键字" style="width:250px" class="input-text">
				<button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜索</button>
			</form>	
			</div>
			<div class="cl pd-5 bg-1 bk-gray mt-20">
				<span class="l">
				
				
				</span>
				<span class="r">评论总数：{{\App\Models\Comment::count()}} 条</span>
			<div class="mt-20">
				<table class="table table-border table-bordered table-bg table-hover table-sort">
					<thead>
						<tr class="text-c">
							<th width="25"><input type="checkbox" name="" value=""></th>
							<th width="30">ID</th>
							<th width="120">评论内容</th>
							<th width="80">评论者</th>
							<th width="100">评论时间</th>
							<th width="120">所属文章</th>
							
							<th width="40">操作</th>
						</tr>
					</thead>
					<tbody>
						@foreach($comments as $comment)
						<tr class="text-c">
							<td><input type="checkbox" value="" name=""></td>
							<td>{{$comment->id}}</td>
							<td class="text-l" title="{{$comment->content}}">{{ str_limit($comment->content,40,'...') }}</td>
							<td>{{$comment->user->name}}</td>
							<td>{{$comment->created_at}}</td>
							<td><a href="{{ route('comments.index',['post_id'=>$comment->post_id]) }}">{{str_limit($comment->post->title,30,'...')}}</a></td>
							
							
							<td class="f-14 td-manage">
							    <a class="label label-danger" data-type="delete" data-url="{{route('comments.delete',$comment)}}" href="javascript:;">删除</a>
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