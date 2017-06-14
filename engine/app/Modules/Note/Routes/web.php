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


/* Админка */
Route::group(['middleware' => 'roles', 'prefix' => 'admin', 'as'=>'admin.'], function () {

    /* Управление заметками */
    Route::group(['prefix' => 'notes', 'roles'=>'admin_notes', 'as'=>'notes.'], function () {

        Route::get('/', [
            'as'=>'edit',
            'uses'=>'NoteController@edit'
        ]);

        Route::post('/post_edit', [
            'as'=>'post_edit',
            'uses'=>'NoteController@post_edit'
        ]);

    });
});