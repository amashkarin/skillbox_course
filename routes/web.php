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

Route::get('/tags/{tag}', \App\Http\Controllers\TagsController::class . '@show')->name('tags.show');
Route::resource('posts', 'App\Http\Controllers\PostsController');

Route::post('/posts/{post}/comment/add', \App\Http\Controllers\CommentsController::class . '@store')->middleware('auth')->name('post.comment.add');


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
    Route::get('/admin/news', \App\Http\Controllers\NewsController::class . '@adminList')->name('admin.news');
    Route::get('/admin/news/create', \App\Http\Controllers\NewsController::class . '@create')->name('news.item.create');
    Route::post('/admin/news/create', \App\Http\Controllers\NewsController::class . '@store')->name('news.item.create');
    Route::get('/admin/news/{newsItem}/edit', \App\Http\Controllers\NewsController::class . '@edit')->name('news.item.edit');
    Route::put('/admin/news/{newsItem}', \App\Http\Controllers\NewsController::class . '@update')->name('news.item.update');
    Route::delete('/admin/news/{newsItem}', \App\Http\Controllers\NewsController::class . '@destroy')->name('news.item.destroy');

});

Route::get('/contacts', 'App\Http\Controllers\FeedbackController@create')->name('contacts');
Route::post('/contacts', 'App\Http\Controllers\FeedbackController@store');


Route::get('/news', \App\Http\Controllers\NewsController::class . '@index')->name('news');
Route::get('/news/{newsItem}', \App\Http\Controllers\NewsController::class . '@show')->name('news.item');
