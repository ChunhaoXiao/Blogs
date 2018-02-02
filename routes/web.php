<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'IndexController@index')->name('indexes.index');
Route::get('show/{post}','IndexController@show')->name('indexes.show') ;
Route::post('add_comment/{post}','CommentController@store')->name('comment_add');
Route::get('notifications','NotificationsController@index')->name('notifications.index');
Route::get('user/setting','UserController@index')->name('user.index');
Route::get('user/changepass','UserController@changePassword')->name('user.changepass');
Route::post('storepass','UserController@storePassword')->name('user.storepass');
Route::get('user/avatar','userController@avatar')->name('user.avatar');
Route::post('user/storeavatar','UserController@storeAvatar')->name('user.storeavatar');
Route::post('comment/thumb/{comment}','CommentController@thumb')->name('comment.thumb');
Route::post('delcomment/{comment}', 'CommentController@destroy')->name('comment.delete');

Route::group(['prefix' => 'admin','namespace'=>'Admin'],function(){

	Route::get('/', 'AdminController@index')->name('admin.index');
	//Route::get('article','Admin\ArticleController@index');

	Route::resource('articles','ArticleController');
	Route::resource('roles','RoleController');
	Route::get('login','LoginController@showLoginForm')->name('admin.login');
	Route::get('posts/trashed','PostController@trashed')->name('posts.trashed');
	Route::post('login','LoginController@dologin')->name('admin.store');
	Route::post('logout','LoginController@adminLogout')->name('admin.logout');
	Route::post('upload','PostController@upload')->name('posts.upload');
	Route::get('post/restore/{id}','PostController@restore')->name('posts.restore');
	Route::delete('post/forcedelete/{post}', 'PostController@forceDelete')->name('posts.forcedelete');
	Route::resource('posts', 'PostController');
	Route::get('setperm/{user}','UserController@setPerm')->name('user.setperm');
	Route::post('storeUserPerm','UserController@storeUserPerm')->name('user.permstore');
	Route::resource('users','UserController');
	Route::resource('permissions','PermissionController');
	Route::resource('menus','MenuController');
	Route::resource('categories','CategoryController');
	Route::get('tags','TagController@index')->name('tags.index');
	Route::get('tag/forbid/{tag}','TagController@forbid')->name('tags.forbid');
	Route::delete('tag_delete/{tag}','TagController@destroy')->name('tags.destroy');
	Route::get('comment','CommentController@index')->name('comments.index');
	Route::get('config/base','ConfigController@base')->name('configs.base');
	Route::post('config/save','ConfigController@store')->name('configs.store');
	Route::get('config/other', 'ConfigController@other')->name('config.other');
	Route::resource('menus','MenuController');
	Route::delete('comment_delete/{comment}','CommentController@destroy')->name('comments.delete') ;

});

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

	Route::get('/home', 'HomeController@index')->name('home');
