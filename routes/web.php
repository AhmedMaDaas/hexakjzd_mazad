<?php

use Illuminate\Support\Facades\Route;

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
    return redirect('/home');
});

Route::group(['namespace' => 'user_controllers'], function(){

	Route::group(['middleware' => 'blockedUser'], function(){

			Route::get('/home','homeController@getHomePage')->name('home.get');

			Route::post('/add-commint','homeController@addCommint')->name('add.commint');

			Route::post('/add-reply-on-commint','homeController@addReply')->name('add.reply');

			Route::post('/like-on-live','homeController@addLikeOnLive')->name('like.on.olive');

			Route::post('/like-on-commint','homeController@addLikeOnCommint')->name('like.on.commint');

			Route::post('/edit-commint','homeController@editCommint')->name('edit.commmint');

			Route::post('/delete-commint','homeController@deleteCommint')->name('delete.commint');

			Route::post('/discount-views','homeController@discountViews');

			Route::get('/welcome','logController@getWelcomePage')->name('welcome');

			Route::post('/checkout','paymentController@checkout')->name('checkout');

			// Route::get('/2checkout-callbak','paymentController@callback');


			// Route::get('/paytab','PaytabsController@index');

			//Route::

			Route::get('/success/{status}','paymentController@makePaymentCallback');

			
	});

	Route::get('/login','logController@getLogPage')->name('login');

	Route::get('/login/{service}','logController@postLogPage')->name('post.login');

	Route::get('/callback/{service}', 'logController@callback');
	
	Route::get('/logout','logController@logout')->name('logout');

	Route::post('/share','homeController@share')->name('share');
});

Route::get('test', function(){
	$mux = new App\Http\Controllers\Classes\MuxPhpStream();
	$mux->createLiveStream();
	$live = $mux->getLiveStream();
	return view('test', ['live' => $live]);
});