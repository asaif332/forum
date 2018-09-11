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

Route::get('/', function () {
    return view('welcome');
});

Route::get('login/{provider}', 'SocialLoginController@redirectToProvider')->name('social.auth');
Route::get('login/{provider}/callback', 'SocialLoginController@handleProviderCallback')->name('social.auth.callback');

Auth::routes();

Route::get('/forum', 'ForumController@index')->name('forum');
Route::get('channels/display/{slug}', 'ChannelsController@display')->name('channels.display');
Route::get('discussions/display/{slug}', 'DiscussionsController@display')->name('discussions.display');


Route::group(['middleware' => 'auth'], function() {
    Route :: get('discussions/watch/{id}' , 'WatchersController@watch')->name('discussions.watch');
    Route :: get('discussions/unwatch/{id}' , 'WatchersController@unwatch')->name('discussions.unwatch');
    Route :: get('replies/like/{id}' , 'RepliesController@like')->name('replies.like');
    Route :: get('replies/unlike/{id}' , 'RepliesController@unlike')->name('replies.unlike');
    Route :: post('replies/save/{id}' , 'DiscussionsController@replySave')->name('replies.save');
    Route :: resource('channels' , 'ChannelsController');
    Route :: resource('discussions' , 'DiscussionsController');
});

