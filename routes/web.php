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

Route::get('/', 'PostsController@index');

Route::get('/new', 'PostsController@new');

Route::post('/posts', 'PostsController@posts');
Route::post('/edit/{id}', 'PostsController@edit');

Route::get('/posts/{id}','PostsController@show');

Route::get('/delete/{id}','PostsController@delete');

Route::get('/change/{id}','PostsController@change');
