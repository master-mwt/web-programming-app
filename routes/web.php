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
Route::get('/help', 'PageWelcomeController@help')->name('help');
Route::get('/about', 'PageWelcomeController@about')->name('about');
Route::get('/contact', 'PageWelcomeController@contact')->name('contact');

// pagehomecontroller routes [w/ auth middleware]
Auth::routes();
Route::get('/home', 'PageHomeController@index')->name('home');
// home post subroutes
Route::get('/home/post/owned', 'PageHomeController@postOwned')->name('home.post.owned');
Route::get('/home/post/saved', 'PageHomeController@postSaved')->name('home.post.saved');
Route::get('/home/post/hidden', 'PageHomeController@postHidden')->name('home.post.hidden');
Route::get('/home/post/reported', 'PageHomeController@postReported')->name('home.post.reported');
// home replies subroutes
Route::get('/home/reply/owned', 'PageHomeController@replyOwned')->name('home.reply.owned');
// home comments subroutes
Route::get('/home/comment/owned', 'PageHomeController@commentOwned')->name('home.comment.owned');
// home channel subroutes
Route::get('/home/channel/owned', 'PageHomeController@channelOwned')->name('home.channel.owned');
Route::get('/home/channel/joined', 'PageHomeController@channelJoined')->name('home.channel.joined');
// user settings route
Route::get('/home/settings', 'PageHomeController@settings')->name('home.settings');

// pagechannelcontroller routes
Route::get('/discover/channel/{id}', 'PageChannelController@channel')->name('discover.channel');

// pagepostcontroller routes
Route::get('/discover/post/{id}', 'PagePostController@post')->name('discover.post');

// pagebackendcontroller routes
Route::group(['middleware' => ['admin']], function() {
    Route::get('/backend/channels', 'PageBackendController@backendChannels')->name('backend.channels');
    Route::get('/backend/tags', 'PageBackendController@backendTags')->name('backend.tags');
    Route::get('/backend/posts', 'PageBackendController@backendPosts')->name('backend.posts');
    Route::get('/backend/replies', 'PageBackendController@backendReplies')->name('backend.replies');
    Route::get('/backend/comments', 'PageBackendController@backendComments')->name('backend.comments');
});

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

// rest controllers [MODEL]
// Route::get('/channels', 'ChannelController@index');
// Route::get('/channels/create', 'ChannelController@create');
// Route::post('/channels', 'ChannelController@store');
// Route::get('/channels/{channel}', 'ChannelController@show');
// Route::get('/channels/{channel}/edit', 'ChannelController@edit');
// Route::patch('/channels/{channel}', 'ChannelController@update');
// Route::delete('/channels/{channel}', 'ChannelController@destroy');
