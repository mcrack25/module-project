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

//Route::auth();

/* Авторизация пользователей */
Route::group(['middleware' => 'web', 'namespace'=>'Auth'], function () {
    Route::get('login', [
        'as' => 'login',
        'uses' => 'LoginController@showLoginForm',
    ]);

    Route::post('login', [
        'as' => 'login_post',
        'uses' => 'LoginController@login',
    ]);

    Route::post('logout', [
        'as' => 'logout',
        'uses' => 'LoginController@logout',
    ]);

    Route::get('logout', [
        'as' => 'getlogout',
        'uses' => 'LoginController@getLogout',
    ]);
});
/* Авторизация пользователей */

/* Регистрация пользователей */
Route::group(['middleware' => 'web','namespace'=>'Auth'], function () {
    Route::get('register', [
        'as' => 'register',
        'uses' => 'RegisterController@showRegistrationForm',
    ]);

    Route::post('register', [
        'as' => 'register_post',
        'uses' => 'RegisterController@register',
    ]);
});
/* Регистрация пользователей */
