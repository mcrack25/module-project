<?php

Route::group(['middleware' => 'web'], function () {

    Route::group(['middleware' => 'roles', 'prefix' => 'admin', 'as' => 'admin.', 'roles' => 'admin_config'], function () {

        Route::group(['prefix' => 'config', 'as' => 'config.'], function () {

            Route::get('/', [
                'as'=>'show',
                'uses'=>'ConfigController@show'
            ]);

            Route::post('/save', [
                'as'=>'post_save',
                'uses'=>'ConfigController@post_save'
            ]);
        });

    });
});