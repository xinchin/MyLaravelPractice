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

