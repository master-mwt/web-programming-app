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
Route::resource('/channels', 'ChannelController');

// temp routes
Route::get('/channel/{id}', 'WelcomeController@channel')->name('channel');
Route::get('/post/{id}', 'WelcomeController@post')->name('post');
Route::get('/search', 'WelcomeController@search')->name('search');

// backend temp routes
Route::get('/backend/channels', 'WelcomeController@backendChannel')->name('backend_channels');
