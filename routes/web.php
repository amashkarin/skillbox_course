<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use \App\Service\PushAllService;

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
Route::get('/', 'App\Http\Controllers\PostsController@index')->name('home');

Route::get('/about', function () {
    $title = 'О нас';
    return view('layout.master', compact('title'));
})->name('about');

Route::group(['middleware' => 'App\Http\Middleware\Admin'], function() {
    Route::get('/admin', 'App\Http\Controllers\AdminSectionController@index')->name('admin');
    Route::get('/admin/feedback', 'App\Http\Controllers\FeedbackController@index')->name('admin.feedback');
    Route::get('/admin/posts', 'App\Http\Controllers\PostsController@adminList')->name('admin.posts');
    Route::get('/admin/posts/{post}/publish', 'App\Http\Controllers\PostsController@publish')->name('admin.post.publish');
    Route::get('/admin/posts/{post}/unpublish', 'App\Http\Controllers\PostsController@unpublish')->name('admin.post.unpublish');
    Route::get('/admin/posts/{post}/edit', 'App\Http\Controllers\PostsController@edit')->name('admin.post.edit');
});

Route::get('/contacts', 'App\Http\Controllers\FeedbackController@create')->name('contacts');
Route::post('/contacts', 'App\Http\Controllers\FeedbackController@store');

