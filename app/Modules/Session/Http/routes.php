<?php

/*
|--------------------------------------------------------------------------
| Module Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for the module.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::group(['prefix' => 'session','middleware' => 'web'], function() {
	Route::get('/login', 'SessionController@login');
	Route::post('/do-login', 'SessionController@do_login');
	Route::get('/forgot-password', 'SessionController@forgot_password');
	Route::post('/do-forgot-password', 'SessionController@do_forgot_password');
	Route::post('/do-register', 'SessionController@do_register');
	Route::get('/reset-password/{slug}', 'SessionController@reset_password');
	Route::post('/do-reset-password', 'SessionController@do_reset_password');
	Route::get('/logout', 'SessionController@do_logout');
});