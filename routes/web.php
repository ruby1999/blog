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

/*Route::get('laravel-version', function(){
    $laravel = app();
    return "Your Laravel version is ".$laravel::VERSION;
});*/



Route::group(['middleware' => 'web'], function () {

    //身分驗證(login、logout、register)
    Auth::routes(); //身分驗證全包
    Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');  //logout有點bug，要獨立寫出來
    //Route::get('login', ['as'=>'login', 'uses'=>'Auth\LoginController@login']); //範例:可以自定義網址(用as)
    //as=>後面接前端 <a herf="/?"> 的名稱 route:list上的name

    //忘記密碼 'URI', 'Action'
    Route::get('password/reset/{token?}', 'Auth\ResetPasswordController@showResetForm');
    Route::get('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::get('password/reset', 'Auth\ResetPasswordController@reset');


    //基本頁面
    Route::get('/home', 'HomeController@index')->name('home');    
    Route::get('blog/{slug}', ['as'=>'blog.single', 'uses'=> 'BlogController@getSingle'])->where('slug', '[\w\d\-\_]+');
    Route::get('blog', ['uses'=>'BlogController@getIndex', 'as'=>'blog.index']);
    //as =>blog資料夾下面的index.blade []表示是array()
    //自定義網址，限定slug中只可以有\w(任何英文字符) \d(任何數字) \_(下底線) \-(dash)
    Route::get('about', 'PagesController@getAbout');
    Route::get('contact', 'PagesController@getContact');
    Route::get('/', 'PagesController@getHome');

    //管理貼文(增刪改查)
    Route::resource('posts','PostController');

    /*Authentication Routes
    Route::get('auth/login', 'Auth\AuthController@getLogin');
    Route::get('auth/login', 'Auth\AuthController@postLogin');
    Route::get('auth/logot', 'Auth\AuthController@getLogot');
    Registeration Routes
    Route::get('auth/register', 'Auth\AuthController@getRegister');
    Route::get('auth/register', 'Auth\AuthController@postRegister');*/

});

