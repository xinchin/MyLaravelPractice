> composer create-project --prefer-dist laravel/laravel demo_1911191508
> 
> composer require laravel/passport
> 
> php artisan migrate
> 
> php artisan passport:keys
> 
> php artisan passport:client



$ php artisan passport:client

 Which user ID should the client be assigned to?:
 >

 What should we name the client?:
 > web1

 Where should we redirect the request after authorization? [http://localhost/auth/callback]:
 > http://localhost:9981/auth/callback

New client created successfully.
Client ID: 1
Client secret: okohIvKpPjDBcVthrRxALd36qFKjOxUfZefen0iS

nelson.huang@wan014033 MINGW64 /d/RD_2019/WebSite/MyLaravelPractice/demo_oauth/demo_1911191508 (master)


