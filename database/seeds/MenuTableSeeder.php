<?php

use Illuminate\Database\Seeder;
use App\Models\Menu ;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $menus = [
			[
				'name' => '文章管理',
			    'url' => 'admin/posts',
			    'group' => '内容管理',
			    'order' => 0,
		    ],
			
			[
				'name' => '内容分类',
				'url' => 'admin/categories',
				'group' => '内容管理',
				'order' => 1,
			],
			[
				'name' => '标签管理',
				'url' => 'admin/tags',
				'group' => '内容管理',
				'order' => 2,

			],
			[
				'name' => '评论管理',
				'url' => 'admin/comment',
				'group'=>'内容管理',
				'order' => 3,
			],
			[
				'name' => '回收站',
				'url' => 'admin/posts/trashed',
				'group' => '内容管理',
				'order' => 4,
			],
			[
				'name' => '用户列表',
				'url' => 'admin/users',
				'group' => '用户管理',
				'order' => 5,
			],
			[
				'name' => '用户角色',
				'url' => 'admin/roles',
				'group' => '用户管理',
				'order' => 6,
			],
			[
				'name' => '菜单管理',
				'url' => 'admin/menus',
				'group' => '菜单管理',
				'order' => 9,
			],
			[
				'name' => '基本设置',
				'url' => 'admin/config/base',
				'group' => '系统设置',
				'order' => 12,
			],
			[
				'name'=>'其它设置',
				'url'=>'admin/config/other',
				'group' => '系统设置',
				'order' => 13,
			]   
	    ] ;
        //dump(factory(App\Models\Menu::class)->make());
        foreach ($menus as $menu) {
	        Menu::firstOrCreate($menu);
        }

    }
}
