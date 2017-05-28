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
Route::get('/', function() {
    return view('index');
});
Route::get('/search_sp', function() {
    return view('part_time.search_pt');
});
Route::get('/login', function() {
    return view('login');
});

Route::get('/register', function() {
    return view('register');
});

Route::get('/sp/command', function() {
    return view('spon.command');
});

Route::post('/register', 'HomeController@store');


//发布赞助或兼职信息(先登录)
//Route::group(['middleware' => 'auth'], function() {
 
    Route::get('/sp/post', function() {
        return view('spon.sp_post');
    });
    Route::get('/pt/post', function() {
        return view('part_time.pt_post');
    });

//});
Route::post('/test', 'HomeController@test');

//赞助、兼职交流社区
Route::get('/sp/community', 'communityController@sp_com');
Route::get('/pt/community', 'communityController@pt_com');

//意见反馈
Route::get('/feedback', 'HomeController@feedback');

//post的为搜索后的搜索结果界面，get为找赞助、兼职的界面
Route::post('/spon', 'HomeController@show_spon');
Route::get('/spon', 'HomeController@show_spon');
Route::post('/part_time', 'HomeController@show_pt');
Route::get('/part_time', 'HomeController@show_pt');

