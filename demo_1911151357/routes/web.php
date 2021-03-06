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

Route::get('/', function () {
    return view('welcome');
});

// 若不要使用者註冊：
// Auth::routes(['register'=>false]);

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');

Route::get('/hello', 'HelloController@index')->name('hello');
Route::get('/hello/show', 'HelloController@show')->name('hello.show');
Route::get('/hello/test', 'HelloController@test')->name('hello.test');

Route::get('/test', function(){
    dump(Auth::user());
    dump(Auth::id());
    dump(Auth::check());
    return time();
});
Route::get('/auth', function(){
    return 'hello auth';
})->middleware('auth');

Route::get('testLogout', function(){
    Auth::logout();
});
