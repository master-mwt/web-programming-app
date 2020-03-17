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

// pagewelcomecontroller routes
Route::get('/', 'PageWelcomeController@index')->name('welcome');
Route::get('/search', 'PageWelcomeController@search')->name('search');

// pagehomecontroller routes [w/ auth middleware]
Auth::routes();
Route::get('/home', 'PageHomeController@index')->name('home');

// pagechannelcontroller routes
Route::get('/channel/{id}', 'PageChannelController@channel')->name('channel');

// pagepostcontroller routes
Route::get('/post/{id}', 'PagePostController@post')->name('post');

// pagebackendcontroller routes
Route::get('/backend/channels', 'PageBackendController@backendChannel')->name('backend_channels');

// rest controllers

// Route::get('/channels', 'ChannelController@index');
// Route::get('/channels/create', 'ChannelController@create');
// Route::post('/channels', 'ChannelController@store');
// Route::get('/channels/{channel}', 'ChannelController@show');
// Route::get('/channels/{channel}/edit', 'ChannelController@edit');
// Route::patch('/channels/{channel}', 'ChannelController@update');
// Route::delete('/channels/{channel}', 'ChannelController@destroy');
Route::resource('/channels', 'ChannelController');

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
