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
Route::group(['middleware' => ['admin']], function() {
    Route::get('/backend/channels', 'PageBackendController@backendChannels')->name('backend.channels');
});

// rest controllers [MODEL]
// Route::get('/channels', 'ChannelController@index');
// Route::get('/channels/create', 'ChannelController@create');
// Route::post('/channels', 'ChannelController@store');
// Route::get('/channels/{channel}', 'ChannelController@show');
// Route::get('/channels/{channel}/edit', 'ChannelController@edit');
// Route::patch('/channels/{channel}', 'ChannelController@update');
// Route::delete('/channels/{channel}', 'ChannelController@destroy');

// rest controllers
Route::group(['middleware' => ['auth']], function() {
    Route::resource('/channels', 'ChannelController');
    Route::resource('/comments', 'CommentController');
    Route::resource('/groups', 'GroupController');
    Route::resource('/images', 'ImageController');
    Route::resource('/logs', 'LogController');
    Route::resource('/posts', 'PostController');
    Route::resource('/replies', 'ReplyController');
    Route::resource('/roles', 'RoleController');
    Route::resource('/services', 'ServiceController');
    Route::resource('/tags', 'TagController');
});
    
