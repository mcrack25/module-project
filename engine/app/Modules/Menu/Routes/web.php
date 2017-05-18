<?php

Route::group(['middleware' => 'web'], function () {

    Route::group(['middleware' => 'roles', 'prefix' => 'admin', 'as' => 'admin.', 'roles'=>'admin_menu'], function () {

        Route::group(['prefix' => 'menu', 'as' => 'menu.'], function () {

            Route::get('/', [
                'as'=>'add',
                'uses'=>'MenuController@add'
            ]);

            Route::get('/edit/{id}', [
                'as'=>'edit',
                'uses'=>'MenuController@edit'
            ])->where(['id'=>'[0-9]+']);

            /* POST запросы */
            Route::post('/post_add', [
                'as'=>'post_add',
                'uses'=>'MenuController@post_add'
            ]);

            Route::post('/post_edit_delete/{id}', [
                'as'=>'post_edit_delete',
                'uses'=>'MenuController@post_actions'
            ])->where(['id'=>'[0-9]+']);


        });

    });
});
