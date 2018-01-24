@extends('admin.layouts.admin')
@section('content')
	<article class="cl pd-20">
		<div class="text-c">
			<span class="select-box inline">
			<form action="{{route('tags.index')}}">		
				
			</span>
				
				<input type="text" name="word" id="" placeholder="标签名" style="width:250px" class="input-text">
				<button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜索</button>
			</form>	
		</div>
		<div class="cl pd-5 bg-1 bk-gray mt-20">
			<span class="l">
			
			
			</span>
			<span class="r">共有标签：<strong>{{\App\Models\Tag::count()}}</strong> 个</span>
		</div>
		<div class="mt-20">
        <table class="table table-border table-bordered table-bg table-hover table-sort">
			<thead>
				<tr class="text-c">
					<th width="25"><input type="checkbox" name="" value=""></th>
					<th width="80">ID</th>
					<th>标签名</th>
					<th width="80">文章数量</th>
					<!-- <th width="80">作者</th>
					<th width="120">更新时间</th>
					<th width="75">浏览次数</th>
					<th width="60">发布状态</th> -->
					<th width="120">操作</th>
				</tr>
			</thead>
		    <tbody>
			@foreach($tags as $tag)
			<tr class="text-c">
				<td><input type="checkbox" value="" name=""></td>
				<td>{{$tag->id}}</td>
				<td class="text-l"><u style="cursor:pointer" class="text-primary" onClick="article_edit('查看','article-zhang.html','10001')" title="查看"><a href="#">{{ $tag->name }}</a></u></td>
				
				<td>{{$tag->posts_count}}</td>
				
				<td class="f-14 td-manage">
					
						<!-- <a style="text-decoration:none" onClick="article_stop(this,'10001')" href="{{route('tags.forbid',$tag)}}" title="禁用"><i class="Hui-iconfont">&#xe6de;</i></a>
						<a style="text-decoration:none" class="ml-5" onClick="article_edit('资讯编辑','article-add.html','10001')" href="#" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a> -->
						<a style="text-decoration:none"  data-type="delete" class="ml-5" data-url="{{route('tags.destroy',$tag)}}"  href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a>
					
				</td>
					
						
			</tr>
		    @endforeach
		</tbody>
    </table>
</form>
</div>
		</article>

@endsection
@section('js')
    <script src="{{ asset('js/ajax.js') }}"></script>
@endsection