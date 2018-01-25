<?php

use Illuminate\Database\Seeder;
use App\Models\Config ;

class ConfigTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = [
        	['name' => 'title', 'value' => '白日梦的博客', 'groups' => 'base'],
        	['name' => 'description', 'value' => '白日做梦', 'groups' => 'base'],
        	['name' => 'keywords', 'value' => 'daydream', 'groups' => 'base'],
        	['name' => 'myname', 'value' => '白日做梦', 'groups' => 'base'],
        	['name' => 'myinfo', 'value' => 'dayDreaming every minutes', 'groups' => 'base'],
        	['name' => 'logpic', 'value' => 'logo/logo.jpeg', 'groups' => 'base'],
        	['name' => 'my_name', 'value' => 'dayDreamer', 'groups' => 'base'],
        	['name' => 'sub_name', 'value' => '做白日梦的人', 'groups' => 'base'],
        	['name' => 'about_me', 'value' => '四十多岁的人依然不忘初心，努力学习 laravel, 想做一名程序猿', 'groups' => 'base'],
        	['name' => 'perpage', 'value' => 10, 'groups' => 'other'],
        	['name' => 'allowcomment', 'value' => 1, 'groups' => 'other'],
        	['name' => 'notice', 'value' => 'msg', 'groups' => 'other'],
        	['name' => 'wordfilter', 'value' => 'fuck', 'groups' => 'other'],
        	['name' => 'ipfilter', 'value' => '', 'groups' => 'other'],
        ] ;
       foreach ($data as $value)
       {
       		Config::firstOrCreate(['name' => $value['name']], $value);
       }

    }
}
