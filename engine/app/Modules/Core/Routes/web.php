<?php

/* Админка */
Route::group(['middleware' => 'roles', 'prefix' => 'admin', 'as'=>'admin.'], function () {

    /* Управление пользователями */
    Route::group(['prefix' => 'users', 'roles'=>'admin_users', 'as'=>'users.'], function () {

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

    /* Управление ролями */
    Route::group(['prefix' => 'roles', 'roles'=>'admin_roles', 'as'=>'roles.'], function () {

        Route::get('/', [
            'as'=>'all',
            'uses'=>'RoleController@all'
        ]);

        Route::get('/add', [
            'as'=>'add',
            'uses'=>'RoleController@add'
        ]);

        Route::get('/edit/{id}', [
            'as'=>'edit',
            'uses'=>'RoleController@edit'
        ])->where(['id'=>'[0-9]+']);

        Route::get('/delete/{id}', [
            'as'=>'delete',
            'uses'=>'RoleController@delete'
        ])->where(['id'=>'[0-9]+']);

        /* POST запросы */
        Route::post('/post_add', [
            'as'=>'post_add',
            'uses'=>'RoleController@post_add'
        ]);

        Route::post('/post_edit/{id}', [
            'as'=>'post_edit',
            'uses'=>'RoleController@post_edit'
        ])->where(['id'=>'[0-9]+']);

        Route::post('/post_delete', [
            'as'=>'post_delete',
            'uses'=>'RoleController@post_delete'
        ]);
    });
    /* Управление ролями */

    /* Управление доступами */
    Route::group(['prefix' => 'access', 'roles'=>'admin_accesses', 'as'=>'access.'], function () {

        Route::get('/', [
            'as'=>'all',
            'uses'=>'AccessController@all'
        ]);

        Route::get('/add', [
            'as'=>'add',
            'uses'=>'AccessController@add'
        ]);

        Route::get('/edit/{id}', [
            'as'=>'edit',
            'uses'=>'AccessController@edit'
        ])->where(['id'=>'[0-9]+']);

        Route::get('/delete/{id}', [
            'as'=>'delete',
            'uses'=>'AccessController@delete'
        ])->where(['id'=>'[0-9]+']);

        /* POST запросы */
        Route::post('/post_add', [
            'as'=>'post_add',
            'uses'=>'AccessController@post_add'
        ]);

        Route::post('/post_edit/{id}', [
            'as'=>'post_edit',
            'uses'=>'AccessController@post_edit'
        ])->where(['id'=>'[0-9]+']);

        Route::post('/post_delete', [
            'as'=>'post_delete',
            'uses'=>'AccessController@post_delete'
        ]);
    });
    /* Управление доступами */

    /* Управление роутами */
    Route::group(['prefix' => 'routes', 'roles'=>'admin_routes', 'as'=>'routes.'], function () {

        Route::get('/', [
            'as'=>'all',
            'uses'=>'RouteController@all'
        ]);

        Route::get('/add', [
            'as'=>'add',
            'uses'=>'RouteController@add'
        ]);

        Route::get('/edit/{id}', [
            'as'=>'edit',
            'uses'=>'RouteController@edit'
        ])->where(['id'=>'[0-9]+']);

        Route::get('/delete/{id}', [
            'as'=>'delete',
            'uses'=>'RouteController@delete'
        ])->where(['id'=>'[0-9]+']);

        /* POST запросы */
        Route::post('/post_add', [
            'as'=>'post_add',
            'uses'=>'RouteController@post_add'
        ]);

        Route::post('/post_edit/{id}', [
            'as'=>'post_edit',
            'uses'=>'RouteController@post_edit'
        ])->where(['id'=>'[0-9]+']);

        Route::post('/post_delete', [
            'as'=>'post_delete',
            'uses'=>'RouteController@post_delete'
        ]);
    });
    /* Управление роутами */
});