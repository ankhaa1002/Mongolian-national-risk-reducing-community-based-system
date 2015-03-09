<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('auth', ['as'=>'login','uses'=>'AdminController@showLogin']);
Route::post('auth/login','AdminController@checkUser');
Route::get('auth/logout',['as'=>'logout','uses'=>'AdminController@logOut']);
Route::get('admin',['as'=>'adminIndex','uses'=>'AdminController@index']);
Route::post('admin/newslist','admin\NewsController@newsList');
Route::post('admin/news/upload',['as'=>'imageUpload','uses'=>'admin\NewsController@upload']);
Route::resource('admin/news', 'Admin\NewsController');
Route::resource('admin/newsCategory', 'Admin\NewsCategoryController');
Route::post('admin/getCategoryList',['as'=>'categoryList','uses'=>'admin\NewsCategoryController@getCategoryList']);
Route::post('admin/addCategory',['as'=>'addCategory','uses'=>'admin\NewsCategoryController@addCategory']);
Route::post('admin/editCategory',['as'=>'editCategory','uses'=>'admin\NewsCategoryController@editCategory']);
Route::resource('admin/page', 'Admin\PageController');
Route::post('admin/pageList','admin\PageController@getPageList');
Route::resource('admin/teacher', 'Admin\TeacherController');
Route::post('admin/teacherList','admin\TeacherController@getTeacherList');