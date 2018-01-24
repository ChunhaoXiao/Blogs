<aside class="Hui-aside">
	<div class="menu_dropdown bk_2">
		@inject('Menus', 'App\Services\MenuServices')
		@foreach($Menus->getMenu() as $group => $menu)
		<dl>
			<dt><i class="Hui-iconfont">&#xe616;</i>{{$group}}<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			
			<dd>
				<ul>
					@foreach($menu as $row)
					    <li><a href="{{ url($row->url)}}" title="{{$row->name}}"> {{$row->name}} </a></li>
					@endforeach
				</ul>
			</dd>
			
		</dl>	
		@endforeach
		
	</div>
</aside>
<div class="dislpayArrow hidden-xs"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a></div>