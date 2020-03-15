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

Route::get('/', 'WelcomeController@index')->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// rest controllers
// Route::get('/channels', 'ChannelController@index');
// Route::get('/channels/create', 'ChannelController@create');
// Route::post('/channels', 'ChannelController@store');
// Route::get('/channels/{channel}', 'ChannelController@show');
// Route::get('/channels/{channel}/edit', 'ChannelController@edit');
// Route::patch('/channels/{channel}', 'ChannelController@update');
// Route::delete('/channels/{channel}', 'ChannelController@destroy');

Route::get('/comments', 'CommentController@index');
Route::post('/comments', 'CommentController@store');
Route::get('/comments/{comment}', 'CommentController@show');
Route::patch('/comments/{comment}', 'CommentController@update');
Route::delete('/comments/{comment}', 'CommentController@destroy');

Route::get('/groups', 'GroupController@index');
Route::post('/groups', 'GroupController@store');
Route::get('/groups/{group}', 'GroupController@show');
Route::patch('/groups/{group}', 'GroupController@update');
Route::delete('/groups/{group}', 'GroupController@destroy');

Route::get('/images', 'ImageController@index');
Route::post('/images', 'ImageController@store');
Route::get('/images/{image}', 'ImageController@show');
Route::patch('/images/{image}', 'ImageController@update');
Route::delete('/images/{image}', 'ImageController@destroy');

Route::get('/logs', 'LogController@index');
Route::post('/logs', 'LogController@store');
Route::get('/logs/{log}', 'LogController@show');
Route::patch('/logs/{log}', 'LogController@update');
Route::delete('/logs/{log}', 'LogController@destroy');

Route::get('/posts', 'PostController@index');
Route::post('/posts', 'PostController@store');
Route::get('/posts/{post}', 'PostController@show');
Route::patch('/posts/{post}', 'PostController@update');
Route::delete('/posts/{post}', 'PostController@destroy');

Route::get('/replies', 'ReplyController@index');
Route::post('/replies', 'ReplyController@store');
Route::get('/replies/{reply}', 'ReplyController@show');
Route::patch('/replies/{reply}', 'ReplyController@update');
Route::delete('/replies/{reply}', 'ReplyController@destroy');

Route::get('/roles', 'RoleController@index');
Route::post('/roles', 'RoleController@store');
Route::get('/roles/{role}', 'RoleController@show');
Route::patch('/roles/{role}', 'RoleController@update');
Route::delete('/roles/{role}', 'RoleController@destroy');

Route::get('/services', 'ServiceController@index');
Route::post('/services', 'ServiceController@store');
Route::get('/services/{service}', 'ServiceController@show');
Route::patch('/services/{service}', 'ServiceController@update');
Route::delete('/services/{service}', 'ServiceController@destroy');

Route::get('/tags', 'TagController@index');
Route::post('/tags', 'TagController@store');
Route::get('/tags/{tag}', 'TagController@show');
Route::patch('/tags/{tag}', 'TagController@update');
Route::delete('/tags/{tag}', 'TagController@destroy');

Route::resource('/channels', 'ChannelController');

// temp routes
Route::get('/channel/{id}', 'WelcomeController@channel')->name('channel');
Route::get('/post/{id}', 'WelcomeController@post')->name('post');
Route::get('/search', 'WelcomeController@search')->name('search');

// backend temp routes
Route::get('/backend/channels', 'WelcomeController@backendChannel')->name('backend_channels');
