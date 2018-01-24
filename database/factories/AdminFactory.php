<?php
$factory->define(App\Models\Admin::class,function(){
	return [
		'name' => 'admin',
		'email' => 'admin@admin.com',
		'password' => bcrypt('password'),
		'remember_token' => str_random(10),
		'groups' => 'manager',
		'is_admin' => 1,
	];
});