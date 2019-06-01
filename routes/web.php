<?php

Route::post('/comment','PostController@comment');

Route::get('/posts', 'PostController@index');

Route::get('/posts/view/{id}', 'PostController@view');

Route::get('/posts/add','PostController@add');
Route::post('/posts/add','PostController@create');

Route::get('posts/edit/{id}','PostController@edit');
Route::post('posts/edit/{id}','PostController@update');
Route::get('posts/delete/{id}', 'PostController@delete');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
