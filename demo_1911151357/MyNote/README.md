> composer create-project --prefer-dist laravel/laravel demo_1911151357

> composer require laravel/ui

> php artisan ui vue --auth

> npm install 

> npm run dev

> php artisan migrate

-------------------

### Description
> Web 認證

### Reference

> https://www.bilibili.com/video/av74879198?p=1

-------------------
### 若不要使用者註冊：
#### web.php
> Auth::routes(['register'=>false]);

-------------

### 重定義：登入後導向的位置
#### LoginController.php
> protected $redirectTo = '/test';


----------

### add a new Controller

> php artisan make:Controller HelloController

--------------
### 登入欄位驗證，email 改為 name

#### LoginController.php

> public function username(){
> 
>       return 'name';
> 
> }
