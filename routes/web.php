<?php
//use Illuminate\Routing\Route;

/*Route::get('laravel-version', function(){
    $laravel = app();
    return "Your Laravel version is ".$laravel::VERSION;
});*/

//use Symfony\Component\Routing\Route;


    Route::group(['middleware' => 'web'], function () {
    
    //身分驗證(login、logout、register)
    Auth::routes(); //身分驗證全包
    
    //忘記密碼 'URI', 'Action'
    Route::post('login', ['as'=>'login', 'uses'=> 'Auth\LoginController@login']);
    Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');  //logout有點bug，要獨立寫出來
    Route::get('password/reset/{token?}', 'Auth\ResetPasswordController@showResetForm');
    Route::get('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
    
    //Category
    Route::resource('categories', 'CategoryController', ['except'=>['create']]); //不要建立create的方法，或是把except改成，只建立哪幾種方法
    
    //Tag
    Route::resource('tags', 'TagController', ['except'=>['create']]); 
    
    //基本頁面
    Route::get('blog/{slug}', ['as'=>'blog.single', 'uses'=> 'BlogController@getSingle'])->where('slug', '[\w\d\-\_]+');
    Route::get('blog', ['uses'=>'BlogController@getIndex', 'as'=>'blog.index']);
    Route::get('about', 'PagesController@getAbout');
    
    //contace me Sendding mail
    Route::get('contact', 'PagesController@getContact');
    Route::post('contact', 'PagesController@postContact');
    Route::get('/', 'PagesController@getHome');

    //管理貼文(增刪改查)
    Route::resource('posts','PostController');
});
    
    //管理貼文(增刪改查)
    
    
    /*Authentication Routes
    Route::get('auth/login', 'Auth\AuthController@getLogin');
    Route::get('auth/login', 'Auth\AuthController@postLogin');
    Route::get('auth/logot', 'Auth\AuthController@getLogot');
    //Registeration Routes
    Route::get('auth/register', 'Auth\AuthController@getRegister');
    Route::get('auth/register', 'Auth\AuthController@postRegister');*/
    

    
    /*Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');
//---------------------------------------------------------
Route::group(['middleware' => ['web']], function () {
	// Authentication Routes
	Route::get('login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
	Route::post('login', 'Auth\LoginController@login');
	Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

	// Registration Routes
	Route::get('auth/register', 'Auth\AuthController@getRegister');
	Route::post('auth/register', 'Auth\AuthController@postRegister');

	// Password Reset Routes
	Route::get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
	Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
	Route::post('password/reset', 'Auth\PasswordController@reset');

	// Categories
	Route::resource('categories', 'CategoryController', ['except' => ['create']]);
	Route::resource('tags', 'TagController', ['except' => ['create']]);
	
	// Comments
	Route::post('comments/{post_id}', ['uses' => 'CommentsController@store', 'as' => 'comments.store']);
	Route::get('comments/{id}/edit', ['uses' => 'CommentsController@edit', 'as' => 'comments.edit']);
	Route::put('comments/{id}', ['uses' => 'CommentsController@update', 'as' => 'comments.update']);
	Route::delete('comments/{id}', ['uses' => 'CommentsController@destroy', 'as' => 'comments.destroy']);
	Route::get('comments/{id}/delete', ['uses' => 'CommentsController@delete', 'as' => 'comments.delete']);

	Route::get('blog/{slug}', ['as' => 'blog.single', 'uses' => 'BlogController@getSingle'])->where('slug', '[\w\d\-\_]+');
	Route::get('blog', ['uses' => 'BlogController@getIndex', 'as' => 'blog.index']);
    Route::get('contact', 'PagesController@getContact');
    Route::post('contact', 'PagesController@postContact');
	Route::get('about', 'PagesController@getAbout');
	Route::get('/', 'PagesController@getHome');
	Route::resource('posts', 'PostController');
});*/