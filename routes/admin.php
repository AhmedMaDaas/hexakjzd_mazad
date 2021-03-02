<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function(){
	Route::get('/', function () {
	    return redirect('admin/settings');
	});

	Route::get('login', 'AuthController@login');

	Route::post('login', 'AuthController@doLogin');

	Route::get('reset/password', 'AuthController@resetPassword');

	Route::post('reset/password', 'AuthController@resetPasswordPost');

	Route::get('reset/password/{token}', 'AuthController@resetPasswordToken');

	Route::post('reset/password/{token}', 'AuthController@resetPasswordTokenPost');

	Route::group(['middleware' => 'admin'], function(){

		Route::any('logout', 'AuthController@logout');

		Route::get('lives/new', 'LiveController@newLive');

		Route::get('lives/current', 'LiveController@currentLive');

		Route::post('lives/create', 'LiveController@create');

		Route::put('lives/update', 'LiveController@update');

		Route::post('lives/delete', 'LiveController@deleteLive');

		Route::get('lives', 'LiveController@allLives');

		Route::get('settings', 'SettingsController@show');

		Route::post('settings/add-store-link', 'SettingsController@addStoreLink');

		Route::post('settings/update-store-link', 'SettingsController@updateStoreLink');

		Route::post('settings/delete-store-link', 'SettingsController@deleteStoreLink');

		Route::post('settings/update-base-info/{id}', 'SettingsController@updateBaseInfo');

		Route::post('settings/update-live-info/{id}', 'SettingsController@updateLiveInfo');

		Route::post('settings/add-advertisement', 'SettingsController@addAdvertisement');

		Route::post('settings/delete-advertisement', 'SettingsController@updateAdvertisement');

		Route::get('certified', 'UsersController@certified');

		Route::get('uncertified', 'UsersController@uncertified');

		Route::get('signed', 'UsersController@signed');

		Route::get('shared', 'UsersController@shared');

		Route::post('update-location', 'UsersController@updateLocation');

		Route::post('update-phone', 'UsersController@updatePhone');

		Route::post('approval', 'UsersController@approval');

		Route::post('block-user', 'UsersController@blocking');

		Route::post('attention', 'UsersController@attention');

		Route::post('choose-winner', 'UsersController@chooseWinner');

		Route::post('confirm-winner', 'UsersController@confirmWinner');

		Route::get('robots', 'RobotsController@users');

		Route::post('robots/create', 'RobotsController@create');

		Route::post('robots/update', 'RobotsController@update');

		Route::post('robots/delete', 'RobotsController@delete');

		Route::get('robots/comments', 'RobotsCommentsController@comments');

		Route::post('robots/add-comment', 'RobotsCommentsController@addComment');

		Route::post('robots/update-comment', 'RobotsCommentsController@updateComment');

		Route::post('robots/delete-comment', 'RobotsCommentsController@deleteComment');

		Route::post('upload-file', 'SettingsController@uploadFile');

		//////////////////////////////////////////////////////////////////////////////////

		Route::get('rt-live','RTLiveController@getRTLivePage');

	    Route::post('change-likes','RTLiveController@changeLiveLikes');

	    Route::post('block','RTLiveController@blockUser');

	    Route::post('change-min-value','RTLiveController@changeMinValue');

	    Route::post('change-views','RTLiveController@changeViews');

	    Route::post('add-robot-commint','RTLiveController@addRobotCommint');

	    Route::post('set-winner','RTLiveController@setWinner');

	    Route::post('change-timer','RTLiveController@changeTimer');

	    Route::post('pause-timer','RTLiveController@pauseTimer');

	    Route::post('play-timer','RTLiveController@playTimer');

	    Route::post('restart-timer','RTLiveController@restartTimer');

	    Route::post('stop-timer','RTLiveController@stopTimer');

	    Route::post('change-bargaining-value','RTLiveController@changeBargainingValue');

	    Route::post('start-live','RTLiveController@startLive');

	    Route::post('end-live','RTLiveController@endLive');

	    Route::post('audio/{status}','RTLiveController@pauseAudio');

	    Route::post('hide-live','RTLiveController@hideLive');

	});

});