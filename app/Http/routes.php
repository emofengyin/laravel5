<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::auth();

Route::get('/', 'HomeController@index');


/*Route::get('now', function () {
    return date('Y-m-d', time());
});

//路由參數
Route::match(['get', 'post'], 'user/{id?}', ['as'=>'usr', function($id=123) {
    return $id;
}]);

//url重定向
Route::any('laravel/test', ['as' => 'test', function(){
    return "重定向";
}]);

Route::any('laravel', function(){
    return redirect()->route('usr', ['id'=>10086]);
});*/


//路由数组(中间件)
/*Route::group(['middleware'=>'test'],function(){
    Route::get('writeage/{age}', function($age){
        return $age;
    });
    Route::get('updateage/{age}', function($age){
        return $age;
    });
});

Route::get('age/refuse', ['as' => 'refuse', function(){
    return '未成年人禁止进入';
}]);*/

//子域名
/*Route::group(['domain' => '{service}.xnf.laravel.com'], function(){
    Route::get('laravel/write', function($service){
        return $service;
    });
    Route::get('laravel/update', function($service) {
        return $service;
    });
});*/


//路由前缀
/*Route::group(['prefix' => 'laravel'], function(){
    Route::get('write', function() {
        return 'write';
    });
    Route::get('update', function() {
       return 'update';
    });
});*/


//群组路由
Route::group(['middleware'=>'auth', 'namespace'=>'Admin', 'prefix'=>'admin'], function(){
    Route::get('/', 'HomeController@index');
    Route::resource('article', 'ArticleController');
    Route::resource('article/{id}/comment', 'CommentController');
});





