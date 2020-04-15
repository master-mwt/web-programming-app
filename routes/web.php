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


//////////////////////////////////////////////////////////////
// GUEST USER ROUTES (AUTHORIZATION) [+AUTH & ADMIN+]
//////////////////////////////////////////////////////////////

//************************************************************
// PAGEWELCOMECONTROLLER ROUTES
//************************************************************
Route::get('/', 'PageWelcomeController@index')->name('welcome');
Route::get('/search', 'PageWelcomeController@search')->name('search');
Route::get('/help', 'PageWelcomeController@help')->name('help');
Route::get('/about', 'PageWelcomeController@about')->name('about');
Route::get('/contact', 'PageWelcomeController@contact')->name('contact');

//************************************************************
// PAGEHOMECONTROLLER ROUTES [w/ AUTH MIDDLEWARE]
//************************************************************
Auth::routes();
Route::get('/home', 'PageHomeController@index')->name('home');
//************************************************************
// PAGEHOMECONTROLLER SUBROUTES [DASHBOARD:POST]
//************************************************************
Route::get('/home/post/owned', 'PageHomeController@postOwned')->name('home.post.owned');
Route::get('/home/post/saved', 'PageHomeController@postSaved')->name('home.post.saved');
Route::get('/home/post/hidden', 'PageHomeController@postHidden')->name('home.post.hidden');
Route::get('/home/post/reported', 'PageHomeController@postReported')->name('home.post.reported');
Route::get('/home/post/upvoted', 'PageHomeController@postUpvoted')->name('home.post.upvoted');
Route::get('/home/post/downvoted', 'PageHomeController@postDownvoted')->name('home.post.downvoted');
//************************************************************
// PAGEHOMECONTROLLER SUBROUTES [DASHBOARD:REPLY]
//************************************************************
Route::get('/home/reply/owned', 'PageHomeController@replyOwned')->name('home.reply.owned');
Route::get('/home/reply/upvoted', 'PageHomeController@replyUpvoted')->name('home.reply.upvoted');
Route::get('/home/reply/downvoted', 'PageHomeController@replyDownvoted')->name('home.reply.downvoted');
//************************************************************
// PAGEHOMECONTROLLER SUBROUTES [DASHBOARD:COMMENT]
//************************************************************
Route::get('/home/comment/owned', 'PageHomeController@commentOwned')->name('home.comment.owned');
//************************************************************
// PAGEHOMECONTROLLER SUBROUTES [DASHBOARD:CHANNEL]
//************************************************************
Route::get('/home/channel/owned', 'PageHomeController@channelOwned')->name('home.channel.owned');
Route::get('/home/channel/joined', 'PageHomeController@channelJoined')->name('home.channel.joined');

//************************************************************
// PAGECHANNELCONTROLLER ROUTES
//************************************************************
Route::get('/discover/channel/{id}', 'PageChannelController@channel')->name('discover.channel');
Route::get('/discover/channel/{id}/members', 'PageChannelController@members')->name('discover.channel.members');

//************************************************************
// PAGEPOSTCONTROLLER ROUTES
//************************************************************
Route::get('/discover/post/{id}', 'PagePostController@post')->name('discover.post');

//************************************************************
// PAGEPOSTCONTROLLER ROUTES
//************************************************************
Route::get('/discover/user/{id}', 'PageUserController@user')->name('discover.user');
Route::get('/discover/user/{id}/posts', 'PageUserController@userPosts')->name('discover.user.posts');


//////////////////////////////////////////////////////////////
// ADMIN USER ROUTES (AUTHORIZATION)
//////////////////////////////////////////////////////////////

Route::group(['middleware' => ['admin']], function() {

    //************************************************************
    // ADMIN:REST ROUTES
    //************************************************************
    Route::resource('/users', 'UserController');
    Route::resource('/channels', 'ChannelController');
    Route::resource('/comments', 'CommentController');
    Route::resource('/groups', 'GroupController');
    Route::resource('/images', 'ImageController');
    Route::resource('/posts', 'PostController');
    Route::resource('/replies', 'ReplyController');
    Route::resource('/roles', 'RoleController');
    Route::resource('/services', 'ServiceController');
    Route::resource('/tags', 'TagController');
});

Route::group(['middleware' => ['access_to_backend']], function() {
    //************************************************************
    // ADMIN:BACKEND ROUTES
    //************************************************************
    Route::get('/backend/channels', 'PageBackendController@backendChannels')->name('backend.channels');
    Route::get('/backend/tags', 'PageBackendController@backendTags')->name('backend.tags');
    Route::get('/backend/posts', 'PageBackendController@backendPosts')->name('backend.posts');
    Route::get('/backend/replies', 'PageBackendController@backendReplies')->name('backend.replies');
    Route::get('/backend/comments', 'PageBackendController@backendComments')->name('backend.comments');
    Route::get('/backend/users', 'PageBackendController@backendUsers')->name('backend.users');
});

Route::group(['middleware' => ['access_to_log']], function() {
    //************************************************************
    // ADMIN:BACKEND ROUTES
    //************************************************************
    Route::get('/backend/logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->name('backend.logs');
});

//////////////////////////////////////////////////////////////
// AUTH USER ROUTES (AUTHORIZATION)
//////////////////////////////////////////////////////////////

Route::group(['middleware' => ['auth']], function() {
    //************************************************************
    // AUTH:ACTIONS ROUTES
    //************************************************************
    Route::get('/posts/{post}/upvote', 'PagePostController@upvote')->name('post.upvote');
    Route::get('/posts/{post}/downvote', 'PagePostController@downvote')->name('post.downvote');
    Route::get('/posts/{post}/save', 'PagePostController@save')->name('post.save');
    Route::get('/posts/{post}/hide', 'PagePostController@hide')->name('post.hide');
    Route::get('/posts/{post}/report', 'PagePostController@report')->name('post.report');
    Route::get('/replies/{reply}/upvote', 'PagePostController@replyUpvote')->name('reply.upvote');
    Route::get('/replies/{reply}/downvote', 'PagePostController@replyDownvote')->name('reply.downvote');
    Route::get('/channels/{channel}/join', 'PageChannelController@joinChannel')->name('channel.join');
    Route::get('/channels/{channel}/leave', 'PageChannelController@leaveChannel')->name('channel.leave');
    Route::get('/channels/{channel}/members/{member}/ban', 'PageChannelController@banUserFromChannel')->name('channel.member.ban');
    Route::get('/channels/{channel}/members/{member}/report', 'PageChannelController@reportUserInChannel')->name('channel.member.report');
    Route::get('/channels/{channel}/members/{member}/upgradetomoderator', 'PageChannelController@upgradeToModerator')->name('channel.member.moderator.upgrade');
    Route::get('/channels/{channel}/members/{member}/upgradetoadmin', 'PageChannelController@upgradeToAdmin')->name('channel.member.admin.upgrade');
    Route::get('/channels/{channel}/members/{member}/downgrademoderator', 'PageChannelController@downgradeModerator')->name('channel.member.moderator.downgrade');
    Route::get('/channels/{channel}/members/{member}/downgradeadmin', 'PageChannelController@downgradeAdmin')->name('channel.member.admin.downgrade');
    //************************************************************
    // AUTH:REST ROUTES
    //************************************************************
    Route::post('/posts', 'PostController@store')->name('post.store');
    Route::post('/replies', 'ReplyController@store')->name('reply.store');
    Route::post('/comments', 'CommentController@store')->name('comment.store');
    Route::get('/users/{user}', 'UserController@show')->name('user.show');
    Route::get('/users/{user}/edit', 'UserController@edit')->name('user.edit');
    Route::patch('/users/{user}', 'UserController@update');
});


//////////////////////////////////////////////////////////////
// REST MODEL ROUTES (ex. channel)
//////////////////////////////////////////////////////////////

// Route::get('/channels', 'ChannelController@index');
// Route::get('/channels/create', 'ChannelController@create');
// Route::post('/channels', 'ChannelController@store');
// Route::get('/channels/{channel}', 'ChannelController@show');
// Route::get('/channels/{channel}/edit', 'ChannelController@edit');
// Route::patch('/channels/{channel}', 'ChannelController@update');
// Route::delete('/channels/{channel}', 'ChannelController@destroy');
