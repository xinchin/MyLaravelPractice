<?php

use Illuminate\Http\Request;
use Laravel\Passport\Passport;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/oauth/token', '\Laravel\Passport\Http\Controllers\AccessTokenController@issueToken');

Route::post('/register', 'PassportController@register');
Route::post('/login', 'PassportController@login');
Route::post('/logout', 'PassportController@logout');
Route::post('/refresh', 'PassportController@refresh');

// Route::get('/test', function(){
//     return 'ok';
// })->middleware('auth');

Route::get('/test', function(){
    $scopeIds = Passport::scopeIds();
    $scopes = Passport::scopes();
    $scopesFor = Passport::scopesFor(['test1','check-status','test2']);
    $hasScope = Passport::hasScope('showshow');

    $result = 'nok';
    if(auth()->user()->tokenCan('test1')){
        $result = 'ok';
    }

    return compact('result','scopeIds','scopes','scopesFor','hasScope');

})->middleware('auth');

// Route::get('/test', function(){
//         return 'ok';
// })->middleware('scope:test1');

// Route::get('/test', function(){
//         return 'ok';
// })->middleware('scope:test2');

// Route::get('/test', function(){
//         return 'ok';
// })->middleware('scope:test1,test2');

