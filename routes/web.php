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

//use Illuminate\Routing\Route;

Route::get('laravel-version', function(){
    $laravel = app();
    return "Your Laravel version is ".$laravel::VERSION;
});



Route::group(['middleware' => 'web'], function () {

    /*Authentication Routes
    
    Route::get('auth/login', 'Auth\AuthController@getLogin');
    //Route::get('auth/login', 'Auth\AuthController@postLogin');
    Route::get('auth/logot', 'Auth\AuthController@getLogot');

    //Registeration Routes
    Route::get('auth/register', 'Auth\AuthController@getRegister');
    Route::get('auth/register', 'Auth\AuthController@postRegister');*/
    
    Route::get('blog/{slug}', ['as'=>'blog.single', 'uses'=> 'BlogController@getSingle'])->where('slug', '[\w\d\-\_]+');
    Route::get('blog', ['uses'=>'BlogController@getIndex', 'as'=>'blog.index']);
    //as =>blog資料夾下面的index.blade []表示是array()
    //自定義網址，限定slug中只可以有\w(任何英文字符) \d(任何數字) \_(下底線) \-(dash)
    Route::get('about', 'PagesController@getAbout');
    Route::get('contact', 'PagesController@getContact');
    Route::get('/', 'PagesController@getHome');
    Route::resource('posts','PostController');

});