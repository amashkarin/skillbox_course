<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::get('/posts/tags/{tag}', 'App\Http\Controllers\TagsController@index');
Route::resource('posts', 'App\Http\Controllers\PostsController');
Route::get('/', 'App\Http\Controllers\PostsController@index');

Route::get('/about', function () {
    $title = 'О нас';
    return view('layout.master', compact('title'));
});

Route::get('/admin/feedback', 'App\Http\Controllers\FeedbackController@index');
Route::get('/contacts', 'App\Http\Controllers\FeedbackController@create');
Route::post('/contacts', 'App\Http\Controllers\FeedbackController@store');


