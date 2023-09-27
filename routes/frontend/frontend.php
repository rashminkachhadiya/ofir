<?php

Route::get('/', 'HomeController@index');
Route::get('/viewNews/{blog}', 'HomeController@viewNews');
Route::get('/thank-you','HomeController@thankYou');


Route::middleware('auth')->group(function ()
{
	Route::resource('order', 'OrderController');
	Route::get('my-account','MyAccountController@index');
	Route::get('catalogue','CatalogueController@index');
	Route::get('catalogue/{sub_catalogue}','CatalogueController@getSubCatalogue');
	Route::get('catalogue/{main_catalogue}/{sub_catalogue}','CatalogueController@getItems');
	Route::post('add-to-cart', 'CatalogueController@addToCart');
	Route::get('cart', 'CatalogueController@cart');
	Route::get('item-remove-cart/{cart_id}', 'CatalogueController@removeToCart');
	Route::get('create-order/{cart_id}', 'CatalogueController@createOrder');
	

	Route::get('item-details/{item_id}','CatalogueController@itemDetails');
	Route::get('my-account/order/{order_id}','MyAccountController@orderDetails');
});