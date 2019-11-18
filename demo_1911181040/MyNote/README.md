### 建立新專案
composer create-project --prefer-dist laravel/laravel demo_1911181040

### 設定：.env
> DB_DATABASE=demo_1911181040
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

> demo_1911181040

### migrate
> php artisan migrate

### make:request
> php artisan make:request BaseRequest

#### BaseRequest.php
> public function wantsJson()
> 
> {
> 
>       return true;
> 
> }
> 
> public function expectsJson()
> 
> {
> 
>       return true;
> 
> }

### make:controller
#### PassportController.php
> php artisan make:controller PassportController

### install passport
> composer require laravel/passport

###  創建表來存儲客戶端和 access_token...
> php artisan migrate

### 生成加密 access_token 的 key、密碼授權客戶端、個人訪問客戶端...

#### command

> php artisan passport:install

#### result
> Encryption keys generated successfully.
> 
> Personal access client created successfully.
> 
> Client ID: 1
> 
> Client secret: 
> 
> s6zKr6MBLQ8ABnYJJJATDTVwGVEenIXcKVA9de0I
> 
> Password grant client created successfully.
> 
> Client ID: 2
> 
> Client secret: 
> 
> hbLymP6HV8rGUC0fZsHutBftO0FVtNN9LGAVeGgh

### 提供一些輔助函數檢查已認證用戶的令牌和使用範圍
#### User.php

> 原本
> 
> use Notifiable;
> 
> 新增
> 
> use Notifiable, HasApiTokens;

