<?php

Route::group(['middleware' => ['web']], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');
    Route::get('/', 'HomeController@index');

    Route::group(['prefix' => 'tasks', 'as' => 'task.', 'middleware' => 'auth'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'TaskController@index']);
        Route::get('/create', ['as' => 'create', 'uses' => 'TaskController@create']);
        Route::post('/', ['as' => 'store', 'uses' => 'TaskController@store']);
        Route::put('/{id}', ['as' => 'mark', 'uses' => 'TaskController@put']);
        Route::delete('/{id}', ['as' => 'delete', 'uses' => 'TaskController@destroy']);
    });
});
