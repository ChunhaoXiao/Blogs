@extends('admin.layouts.admin');

@section('content')
    
<body>
<!--_header 作为公共模版分离出去-->

<!--/_header 作为公共模版分离出去-->

<!--_menu 作为公共模版分离出去-->

<!--/_menu 作为公共模版分离出去-->


	<!-- <nav class="breadcrumb"><i class="Hui-iconfont"></i> <a href="/" class="maincolor">首页</a> 
		<span class="c-999 en">&gt;</span>
		<span class="c-666">我的桌面</span> 
		<a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav> -->
	<div class="Hui-article">
		<article class="cl pd-20">
			<p class="f-20 text-success">你好 {{Auth::user()->name}}
				
				</p>
			<p>登录次数：{{Auth::user()->login_times}} </p>
			<p>上次登录IP：{{Auth::user()->last_login_ip}}  上次登录时间：{{Auth::user()->last_login_time}}</p>
			<table class="table table-border table-bordered table-bg">
				<thead>
					<tr>
						<th colspan="2">信息统计</th>
			</tr>
					
		</thead>
		<tbody>
				<tr><td width="50%">文章数量</td><td>{{\App\Models\Post::count()}}</td></tr>
				<tr><td>用户数量</td><td>{{\App\Models\User::count()}}</td></tr>	
				<tr><td>评论数</td><td>{{\App\Models\Comment::count()}}</td></tr>
				<tr><td>标签数</td><td>{{\App\Models\Tag::count()}}</td></tr>
		</tbody>
	</table>
			<table class="table table-border table-bordered table-bg mt-20">
				<thead>
					<tr>
						<th colspan="2" scope="col">服务器信息</th>
			</tr>
		</thead>
				<tbody>
					<tr>
						<td>操作系统</td>
						<td><span id="lbServerName">{{Sysinfo::server()}}</span></td>
			</tr>
					<tr>
						<td>服务器IP地址</td>
						<td>{{ Sysinfo::ip() }}</td>
			</tr>
			<tr>
				<td>当前时区</td>
				<td>{{Sysinfo::timezone()}}</td>
			</tr>
					<tr>

						<td>CPU</td>
						<td>{{Sysinfo::cpu()}}</td>
			</tr>
					<tr>
						<td>总内存 </td>
						<td>{{Sysinfo::memory()}}</td>
			</tr>
					<tr>
						<td>PHP版本 </td>
						<td>{{Sysinfo::php()}}</td>
			</tr>
					<tr>
						<td>最大文件上传尺寸 </td>
						<td>{{Sysinfo::upload_max_filesize()}}</td>
			</tr>
					<tr>
						<td>laravel版本 </td>
						<td>{{Sysinfo::laraver()}}</td>
			</tr>
					<tr>
						<td>Mysql版本 </td>
						<td>{{Sysinfo::mysql()}}</td>
			</tr>
					
		</tbody>
	</table>

@endsection
		
</div>
</section>




<!--/此乃百度统计代码，请自行删除-->
</body>
</html>