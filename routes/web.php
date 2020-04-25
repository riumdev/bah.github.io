
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
// ===================== client
Route::get('/', "PageController@honePage");
Route::post('/addQuestion', 'PageController@addQuestion');






// ===================== admin
Route::get('login', "PageController@login" );
Route::post('login', "PageController@postLogin" );

Route::group(['middleware' => 'checkAdminLogin','prefix' => "admin"], function() {

	Route::get('/', 'AdminController@Dashboard');
	Route::get('/dashboard','AdminController@Dashboard');
	Route::get('/logout', 'AdminController@getLogout');
	// Answer
	Route::post('/addAnswer', 'AdminController@postAnswer');

	// change pass
	Route::get('/change-pass',  'AdminController@getChangePassword');
	Route::post('/change-pass', 'AdminController@postChangePassword');

});
