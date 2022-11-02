<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('main');
});

Route::get('/posts', 'PostsController@index')->name('post.index');
Route::get('/posts/create', 'PostsController@create')->name('post.create');
Route::post('/posts', 'PostsController@store')->name('post.store');
Route::get('/posts/{post}', 'PostsController@show')->name('post.show');
Route::get('/posts/{post}/edit', 'PostsController@edit')->name('post.edit');
Route::patch('/posts/{post}', 'PostsController@update')->name('post.update');
Route::delete('/posts/{post}', 'PostsController@destroy')->name('post.destroy');

Route::get('/posts/update', 'PostsController@update');
Route::get('/posts/delete', 'PostsController@delete');
Route::get('/posts/update_or_create', 'PostsController@updateOrCreate');

Route::get('/main', 'MainController@index')->name('main.index');
Route::get('/about', 'AboutController@index')->name('about.index');
Route::get('/contacts', 'ContactController@index')->name('contact.index');
Route::get('/xml', 'XmlController@index')->name('xml.index');
