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
/*
 * Authentication route
 */
Route::get('auth', ['as'=>'login','uses'=>'AdminController@showLogin']);
Route::post('auth/login','AdminController@checkUser');
Route::get('auth/logout',['as'=>'logout','uses'=>'AdminController@logOut']);
/*
 * Admin route
 */
Route::get('admin',['as'=>'adminIndex','uses'=>'AdminController@index']);
/*
 * News route
 */
Route::post('admin/newslist','admin\NewsController@newsList');
Route::post('admin/news/upload',['as'=>'imageUpload','uses'=>'admin\NewsController@upload']);
Route::resource('admin/news', 'Admin\NewsController');
/*
 * News category route
 */
Route::resource('admin/newsCategory', 'Admin\NewsCategoryController');
Route::post('admin/getCategoryList',['as'=>'categoryList','uses'=>'admin\NewsCategoryController@getCategoryList']);
Route::post('admin/addCategory',['as'=>'addCategory','uses'=>'admin\NewsCategoryController@addCategory']);
Route::post('admin/editCategory',['as'=>'editCategory','uses'=>'admin\NewsCategoryController@editCategory']);
/*
 * Page route
 */
Route::resource('admin/page', 'Admin\PageController');
Route::post('admin/pageList','admin\PageController@getPageList');
/*
 * Teacher route
 */
Route::resource('admin/teacher', 'Admin\TeacherController');
Route::post('admin/teacherList','admin\TeacherController@getTeacherList');
/*
 * User route
 */
Route::resource('admin/user', 'Admin\UserController');
Route::post('admin/userList','Admin\UserController@userList');
/*
 * Lesson category route
 */
Route::resource('admin/lessonCategory', 'Admin\LessonCategoryController');
Route::post('admin/lessonCategoryList',['as'=>'lessonCategoryList','uses'=>'admin\LessonCategoryController@lessonCategoryList']);
Route::post('admin/addLessonCategory',['as'=>'addLessonCategory','uses'=>'admin\LessonCategoryController@addLessonCategory']);

/**
 * Config routes
 */
Route::resource('admin/config', 'Admin\ConfigController');

/*
 * Lesson channel route
 */
Route::resource('admin/lessonChannel', 'Admin\LessonChannelController');
Route::post('admin/lessonChannelList',['as'=>'lessonChannelList','uses'=>'admin\LessonChannelController@lessonChannelList']);
Route::post('admin/addLessonChannel',['as'=>'addLessonChannel','uses'=>'admin\LessonChannelController@addLessonChannel']);
/**
 * Lesson route
 */
Route::resource('admin/lesson', 'Admin\LessonController');
Route::post('admin/lessonlist','Admin\LessonController@allLessons');
/**
 * Teacher Controller
 */
Route::get('teacherLogin', ['as'=>'teacherLogin','uses'=>'TeacherController@showLogin']);
Route::get('adminTeacher', ['as'=>'adminTeacher','uses'=>'TeacherController@index']);
Route::post('teacherLogin','TeacherController@checkTeacher');
Route::get('teacherLogout',['as'=>'teacherLogout','uses'=>'TeacherController@logOut']);
Route::post('adminTeacher/lesson/upload',['as'=>'teacherImageUpload','uses'=>'Teacher\LessonController@upload']);
/**
 * Teacher Lesson Controller
 */
Route::resource('adminTeacher/lesson', 'Teacher\LessonController');
Route::post('adminTeacher/lessonlist','Teacher\LessonController@lessonList');

/**
 * Statistic
 */
Route::get('adminTeacher/categoryStat','TeacherController@categoryStat');
Route::get('adminTeacher/channelStat','TeacherController@channelStat');

/*
 * Report routes
 */
Route::get('admin/lessonByCategory','Admin\ReportController@lessonByCategoryReport');
Route::get('admin/lessonByChannel','Admin\ReportController@lessonByChannelReport');
Route::get('statistics',['as'=>'statistics','uses'=>'Front\ReportController@index']);
/*
 * Main routes
 */
Route::get('/',['as'=>'index','uses'=>'MainController@index']);
Route::resource('news', 'Front\NewsController');
Route::resource('category', 'Front\CategoryController');
Route::resource('lesson', 'Front\LessonController');
Route::resource('teacher', 'Front\TeacherController');
Route::resource('lesson/category', 'Front\LessonCategoryController');
Route::resource('lesson/channel', 'Front\LessonChannelController');
Route::get('pages/{slug}', ['as'=>'pages','uses'=>'Front\PageController@show']);
Route::get('aimag/{id}', ['as'=>'aimag','uses'=>'Front\AffiliationController@showAimag']);
Route::get('district/{id}', ['as'=>'district','uses'=>'Front\AffiliationController@showDistrict']);