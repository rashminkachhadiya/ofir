<?php

Route::get('/', 'HomeController@index');
Route::get('/viewNews/{blog}', 'HomeController@viewNews');


Route::middleware('auth')->group(function ()
{
	Route::resource('order', 'OrderController');
	Route::get('my-account','MyAccountController@index');
	Route::get('catalogue','CatalogueController@index');
	Route::get('catalogue/{sub_catalogue}','CatalogueController@getSubCatalogue');
	Route::get('catalogue/{main_catalogue}/{sub_catalogue}','CatalogueController@getItems');

	Route::get('my-account/order/{order_id}','MyAccountController@orderDetails');
});