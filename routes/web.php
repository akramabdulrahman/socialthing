<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::resource('posts','UserTimeLineController');
Route::get('/home', 'UserTimeLineController@index');
Route::post('/comments/', 'UserTimeLineController@storeOnPost')->name('comment_on_post');
Route::post('/comments/reply', 'UserTimeLineController@storeOnComment')->name('comment_on_comment');
Route::post('/posts/', 'UserTimeLineController@store')->name('store_post');

Route::get('/test', function () {
    $posts = \App\Models\Social\Post::with('media')->get();
    dd($posts->toArray());

});
