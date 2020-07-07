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

    Route::get('/about', 'PagesController@getAbout');
    Route::get('/contact', 'PagesController@getContact');
    Route::get('/', 'PagesController@getHome');
    Route::resource('posts','PostController');

});