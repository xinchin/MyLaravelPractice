### 建立新專案
> composer create-project --prefer-dist laravel/laravel demo_1911151659

### 設定：.env
> DB_DATABASE=demo_1911151659
> 
> DB_USERNAME=
> 
> DB_PASSWORD=

### AppServiceProvider.php

> public function boot()
> 
> {
> 
>       Schema::defaultStringLength(191);
> 
> }

### 建立 Database

> demo_1911151659


### migrate
> php artisan migrate

### User.php
>   protected $fillable = [
> 
>        'name', 'email', 'password', 'api_token'
> 
>    ];

### make:request
> php artisan make:request BaseRequest

### Setting Route
#### api.php

Route::post('/register', 'Auth\ApiController@register');
Route::post('/login', 'Auth\ApiController@login');
Route::post('/refresh', 'Auth\ApiController@refresh');
Route::post('/logout', 'Auth\ApiController@logout');

### make Controller
#### Auth\ApiController
> php artisan make:Controller Auth\ApiController
