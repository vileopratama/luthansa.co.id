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

Route::group(['prefix' => 'customer','middleware' => ['web','permission']], function() {
	Route::get('/', 'CustomerController@index');
	Route::get('/view/{slug}', 'CustomerController@view');
	Route::get('/sales-order', 'CustomerController@sales_order');
	Route::get('/sales-order/view/{slug}', 'CustomerController@view_sales_order');
	Route::get('/sales-order/download/invoice/{slug}', 'CustomerController@download_invoice_sales_order');
	Route::post('/sales-order/do-confirm-payment', 'CustomerController@do_confirm_payment');
	Route::get('/sales-invoice', 'CustomerController@sales_invoice');
	Route::get('/sales-invoice/view/{slug}', 'CustomerController@view_sales_invoice');
	Route::get('/sales-invoice/download/invoice/{slug}', 'CustomerController@download_invoice_sales_invoice');
	Route::get('/profile', 'CustomerController@profile');
	Route::post('/profile/do-update', 'CustomerController@do_update_profile');
	Route::get('/change-password', 'CustomerController@change_password');
	Route::post('/change-password/do-update', 'CustomerController@do_update_password');
});