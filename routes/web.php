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

Route::get('/posts/tags/{tag}', 'TagsController@index');
Route::resource('posts', 'PostsController');
Route::get('/', 'PostsController@index');

Route::get('/about', function () {
    $title = 'О нас';
    return view('layout.master', compact('title'));
});

Route::get('/admin/feedback', 'FeedbackController@index');
Route::get('/contacts', 'FeedbackController@create');
Route::post('/contacts', 'FeedbackController@store');


