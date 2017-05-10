<?php

/* Админка */
Route::group(['middleware' => 'roles', 'prefix' => 'admin', 'as'=>'admin.'], function () {

    /* Управление пользователями */
    Route::group(['prefix' => 'users', 'roles'=>'admin_index', 'as'=>'users.'], function () {

        Route::get('/', [
            'as'=>'all',
            'uses'=>'UserController@all'
        ]);

        Route::get('/add', [
            'as'=>'add',
            'uses'=>'UserController@add'
        ]);

        Route::get('/edit/{id}', [
            'as'=>'edit',
            'uses'=>'UserController@edit'
        ])->where(['id'=>'[0-9]+']);

        Route::get('/delete/{id}', [
            'as'=>'delete',
            'uses'=>'UserController@delete'
        ])->where(['id'=>'[0-9]+']);

        /* POST запросы */
        Route::post('/post_add', [
            'as'=>'post_add',
            'uses'=>'UserController@post_add'
        ]);

        Route::post('/post_edit/{id}', [
            'as'=>'post_edit',
            'uses'=>'UserController@post_edit'
        ])->where(['id'=>'[0-9]+']);

        Route::post('/post_delete', [
            'as'=>'post_delete',
            'uses'=>'UserController@post_delete'
        ]);
    });
    /* Управление пользователями */
});