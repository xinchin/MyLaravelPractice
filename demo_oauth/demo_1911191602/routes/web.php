<?php
$clientId = 1;
$clientSecret = 'okohIvKpPjDBcVthrRxALd36qFKjOxUfZefen0iS';
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

Route::view('/login', 'login');
Route::view('/auth/callback', 'auth_callback');

Route::get('/web1/login', function(\Illuminate\Http\Request $request) use($clientId){
    $request->session()->put('state', $state = \Illuminate\Support\Str::random(40) );
    $query = http_build_query([
        'client_id'=>$clientId,
        'redirect_uri'=>'http://localhost:9982/auth/callback',
        'response_type'=>'code',
        'scope'=> '*',
        'state'=>$state,
    ]);
    return redirect('http://localhost:9981/oauth/authorize?'.$query);
});
