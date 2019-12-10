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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//將用戶重新導向至OAuth提供程序
Route::get('login/github', 'Auth\LoginController@redirectToProvider');

//在身份驗證之後接收來自提供程序的回調。
Route::get('login/github/callback', 'Auth\LoginController@handleProviderCallback');
