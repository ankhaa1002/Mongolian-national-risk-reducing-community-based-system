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

Route::get('auth', 'AdminController@showLogin');
Route::post('auth/login','AdminController@checkUser');
Route::get('auth/logout',['as'=>'logout','uses'=>'AdminController@logOut']);
Route::get('admin',['as'=>'adminIndex','uses'=>'AdminController@showIndex']);
Route::resource('admin/news', 'Admin\NewsController');
Route::post('admin/newslist','admin\NewsController@newsList');
Route::post('admin/news/upload','admin\NewsController@upload');


