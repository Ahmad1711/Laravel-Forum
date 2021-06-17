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

Auth::routes();

Route::get('/dashboard/{filter?}', 'HomeController@index')->name('dashboard');
Route::get('{provider}/auth','SocialsController@auth')->name('social.auth');
Route::get('/{provider}/redirect', 'SocialsController@auth_redirect')->name('social.redirect');

Route::get('/discussion/watch/{id}', 'WatchersController@watch')->name('discussion.watch');
Route::get('/discussion/unwatch/{id}', 'WatchersController@unwatch')->name('discussion.unwatch');

Route::group(['middleware'=>'auth'],function(){
    Route::resource('channels', 'ChannelsController');
    Route::resource('discussions', 'DiscussionsController');
    Route::resource('replys','ReplyController');
    Route::get('/reply/like/{id}','ReplyController@like')->name('replys.like');
    Route::get('/reply/unlike/{id}', 'ReplyController@unlike')->name('replys.unlike');
    Route::get('/reply/bestanswer/{id}', 'ReplyController@bestanswer')->name('replys.bestanswer');
    
});