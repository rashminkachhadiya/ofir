<?php

Route::get('/', 'HomeController@index');
Route::get('/viewNews/{blog}', 'HomeController@viewNews');


Route::middleware('auth')->group(function ()
{
	Route::resource('order', 'OrderController');
	Route::get('my-account','MyAccountController@index');
	Route::get('my-account/order/{order_id}','MyAccountController@orderDetails');
});