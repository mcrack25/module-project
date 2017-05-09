<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your module. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::group(['middleware' => 'web'], function () {

    Route::group(['middleware' => 'roles', 'prefix' => 'admin', 'as' => 'admin.', 'roles'=>'admin_index'], function () {

        Route::group(['prefix' => 'menu', 'as' => 'menu.'], function () {

            Route::get('/', [
                'as'=>'all',
                'uses'=>'MenuController@index'
            ]);

        });

    });
});
