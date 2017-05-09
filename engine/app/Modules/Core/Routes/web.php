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
        Route::get('/post_add', [
            'as'=>'post_add',
            'uses'=>'UserController@post_add'
        ]);

        Route::get('/post_edit/{id}', [
            'as'=>'post_edit',
            'uses'=>'UserController@post_edit'
        ])->where(['id'=>'[0-9]+']);

        Route::get('/post_delete/{id}', [
            'as'=>'post_delete',
            'uses'=>'UserController@post_delete'
        ])->where(['id'=>'[0-9]+']);
    });
    /* Управление пользователями */
});