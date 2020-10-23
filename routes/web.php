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
// Route::get('/help', 'PageWelcomeController@help')->name('help');
Route::get('/about', 'PageWelcomeController@about')->name('about');
Route::get('/contact', 'PageWelcomeController@contact')->name('contact');

//************************************************************
// PAGEHOMECONTROLLER ROUTES [w/ AUTH MIDDLEWARE]
//************************************************************
Auth::routes();
Route::get('/home', 'PageHomeController@index')->name('home');
//************************************************************
// PAGEHOMECONTROLLER SUBROUTES [PROFILE IMAGE UPLOAD]
//************************************************************
Route::get('/home/profile/image/upload', 'PageHomeController@imageUpload')->name('home.profile.image.upload');
Route::post('/home/profile/image/upload', 'PageHomeController@imageUploadStore')->name('home.profile.image.upload.store');

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
//************************************************************
// PAGECHANNELCONTROLLER SUBROUTES [CHANNEL IMAGE UPLOAD]
//************************************************************
Route::get('/home/channel/{id}/image/upload', 'PageChannelController@imageUpload')->name('home.channel.image.upload');
Route::post('/home/channel/image/upload', 'PageChannelController@imageUploadStore')->name('home.channel.image.upload.store');

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
    //Route::resource('/groups', 'GroupController');
    Route::resource('/images', 'ImageController');
    Route::resource('/posts', 'PostController');
    Route::resource('/replies', 'ReplyController');
    //Route::resource('/roles', 'RoleController');
    //Route::resource('/services', 'ServiceController');
    Route::resource('/tags', 'TagController');

    //************************************************************
    // ADMIN:ACTION ROUTES
    //************************************************************
    Route::get('/users/{user}/hardban', 'PageBackendController@hardBanUser')->name('backend.user.hardban');
    Route::get('/users/{user}/unhardban', 'PageBackendController@unHardBanUser')->name('backend.user.unhardban');

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
    // AUTH:ACTIONS ROUTES - POST
    //************************************************************
    Route::get('/posts/{post}/upvote', 'PagePostController@upvote')->name('post.upvote');
    Route::get('/posts/{post}/downvote', 'PagePostController@downvote')->name('post.downvote');
    Route::get('/posts/{post}/save', 'PagePostController@save')->name('post.save');
    Route::get('/posts/{post}/hide', 'PagePostController@hide')->name('post.hide');
    Route::get('/posts/{post}/report', 'PagePostController@report')->name('post.report');
    Route::delete('/posts/{post}', 'PostController@destroy')->name('post.delete');
    Route::get('/posts/{post}/globalunreport', 'PagePostController@postGlobalUnreport')->name('post.globalunreport');

    //************************************************************
    // AUTH:ACTIONS ROUTES - REPLY
    //************************************************************
    Route::get('/replies/{reply}/upvote', 'PagePostController@replyUpvote')->name('reply.upvote');
    Route::get('/replies/{reply}/downvote', 'PagePostController@replyDownvote')->name('reply.downvote');
    Route::delete('/replies/{reply}', 'ReplyController@destroy')->name('reply.delete');

    //************************************************************
    // AUTH:ACTIONS ROUTES - COMMENT
    //************************************************************
    Route::delete('/comments/{comment}', 'CommentController@destroy')->name('comment.delete');

    //************************************************************
    // AUTH:ACTIONS ROUTES - CHANNEL
    //************************************************************
    Route::get('/channels/{channel}/join', 'PageChannelController@joinChannel')->name('channel.join');
    Route::get('/channels/{channel}/leave', 'PageChannelController@leaveChannel')->name('channel.leave');
    Route::get('/channels/{channel}/edit', 'ChannelController@edit')->name('channel.edit');
    Route::patch('/channels/{channel}', 'ChannelController@update')->name('channel.update');
    Route::delete('/channels/{channel}', 'ChannelController@destroy')->name('channel.delete');

    //************************************************************
    // AUTH:ACTIONS ROUTES - CHANNEL -> MEMBERS
    //************************************************************
    Route::get('/discover/channel/{id}/members', 'PageChannelController@members')->name('discover.channel.members');
    Route::get('/channels/{channel}/members/{member}/ban', 'PageChannelController@banUserFromChannel')->name('channel.member.ban');
    Route::get('/channels/{channel}/members/{member}/unban', 'PageChannelController@unBanUserFromChannel')->name('channel.member.unban');
    Route::get('/channels/{channel}/members/{member}/report', 'PageChannelController@reportUserInChannel')->name('channel.member.report');
    Route::get('/channels/{channel}/members/{member}/unreport', 'PageChannelController@unReportUserInChannel')->name('channel.member.unreport');
    Route::get('/channels/{channel}/members/{member}/upgradetomoderator', 'PageChannelController@upgradeToModerator')->name('channel.member.moderator.upgrade');
    Route::get('/channels/{channel}/members/{member}/upgradetoadmin', 'PageChannelController@upgradeToAdmin')->name('channel.member.admin.upgrade');
    Route::get('/channels/{channel}/members/{member}/upgradetocreator', 'PageChannelController@upgradeToCreator')->name('channel.member.creator.upgrade');
    Route::get('/channels/{channel}/members/{member}/downgrademoderator', 'PageChannelController@downgradeModerator')->name('channel.member.moderator.downgrade');
    Route::get('/channels/{channel}/members/{member}/downgradeadmin', 'PageChannelController@downgradeAdmin')->name('channel.member.admin.downgrade');
    Route::get('/channels/{channel}/members/{member}/downgradecreator', 'PageChannelController@downgradeCreator')->name('channel.member.creator.downgrade');

    //************************************************************
    // AUTH:ACTIONS ROUTES - CHANNEL -> BANNED USERS
    //************************************************************
    Route::get('/discover/channel/{id}/banned_users', 'PageChannelController@bannedUsers')->name('discover.channel.banned_users');

    //************************************************************
    // AUTH:ACTIONS ROUTES - CHANNEL -> REPORTED POSTS
    //************************************************************
    Route::get('/discover/channel/{id}/reported_posts', 'PageChannelController@reportedPosts')->name('discover.channel.reported_posts');

    //************************************************************
    // AUTH:REST ROUTES
    //************************************************************
    Route::post('/posts', 'PostController@store')->name('posts.store');
    Route::post('/replies', 'ReplyController@store')->name('replies.store');
    Route::post('/comments', 'CommentController@store')->name('comment.store');

    Route::get('/users/{user}', 'UserController@show')->name('users.show');
    Route::get('/images/{image}', 'ImageController@show')->name('images.show');
    Route::get('/users/{user}/edit', 'UserController@edit')->name('users.edit');
    Route::patch('/users/{user}', 'UserController@update');

    Route::get('/channels/create', 'ChannelController@create')->name('channels.create');
    Route::post('/channels', 'ChannelController@store');

    //************************************************************
    // AUTH:NOTIFICATIONS ROUTES
    //************************************************************
    Route::get('/notifications', 'UserController@notifications');
    Route::get('/clearnotifications', 'UserController@clearNotifications')->name('notification.clear');

    //************************************************************
    // AUTH:ACTIONS ROUTES
    //************************************************************
    Route::get('/channels/{channel}/removeimage', 'PageChannelController@removeImage')->name('channel.removeimage');
    Route::get('/users/{user}/removeimage', 'PageHomeController@removeImage')->name('user.removeimage');

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
