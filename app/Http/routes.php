<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

    Route::group(['prefix'=>'admin', 'middleware' => 'auth', 'where'=> ['id'=> '[0-9]+']], function()
    {
	Route::group(['prefix'=>'categories'], function(){
		
        Route::get('/',                 ['as'=>'categories', 'uses'=>'AdminCategoriesController@index']);
        Route::post('/',                ['as'=>'categories.store', 'uses'=>'AdminCategoriesController@store']); // Rota para action adicionar ao banco
        Route::get('/create',           ['as'=>'categories.create', 'uses'=>'AdminCategoriesController@create']);
        Route::get('/{id}/destroy',     ['as'=>'categories.destroy', 'uses'=>'AdminCategoriesController@destroy']);
        Route::get('/{id}/edit',        ['as'=>'categories.edit', 'uses'=>'AdminCategoriesController@edit']);
        Route::put('/{id}/update',      ['as'=>'categories.update', 'uses'=>'AdminCategoriesController@update']);
    });
    Route::group(['prefix'=>'products'], function(){
		
        Route::get('/',['as'=>'products', 'uses'=>'AdminProductsController@index']);
        Route::post('/',['as'=>'products.store', 'uses'=>'AdminProductsController@store']);
        Route::get('/create',['as'=>'products.create', 'uses'=>'AdminProductsController@create']);
        Route::get('/{id}/destroy',['as'=>'products.destroy', 'uses'=>'AdminProductsController@destroy']);
        Route::get('/{id}/edit',['as'=>'products.edit', 'uses'=>'AdminProductsController@edit']);
        Route::put('/{id}/update',['as'=>'products.update', 'uses'=>'AdminProductsController@update']);
    
	Route::group(['prefix'=>'images'], function(){
	
	    Route::get('{id}/product',['as'=>'products.images', 'uses'=>'AdminProductsController@images']);
	    Route::get('create/{id}/product',['as'=>'products.images.create', 'uses'=>'AdminProductsController@createImage']);
		Route::post('store/{id}/product',['as'=>'products.images.store', 'uses'=>'AdminProductsController@storeImage']);
        Route::get('destroy/{id}/image',['as'=>'products.images.destroy', 'uses'=>'AdminProductsController@destroyImage']);
	});

        Route::group(['prefix'=>'tags'], function(){
    
        Route::get('{id}/product',['as'=>'products.tags', 'uses'=>'AdminProductsController@tags']);
        Route::get('create/{id}/product',['as'=>'products.tags.create', 'uses'=>'AdminProductsController@createTag']);
        Route::post('store/{id}/product',['as'=>'products.tags.store', 'uses'=>'AdminProductsController@storeTag']);
        Route::get('destroy/{id}/tag',['as'=>'products.tags.destroy', 'uses'=>'AdminProductsController@destroyTag']);
    });

	});

	
});


Route::get('/home', 'HomeController@index');

Route::get('/', 'StoreController@index');

Route::get('category/{id}',         ['as' => 'store.category', 'uses' => 'StoreController@category']);
Route::get('product/{id}',          ['as' => 'store.product', 'uses' => 'StoreController@product']);
Route::get('tag/{id}',              ['as' => 'store.tag', 'uses' => 'StoreController@tag']);
Route::get('cart',                  ['as' => 'cart', 'uses' => 'CartController@index']);
Route::get('cart/add/{id}',         ['as' => 'cart.add', 'uses' => 'CartController@add']);
Route::get('cart/destroy/{id}',     ['as' => 'cart.destroy', 'uses' => 'CartController@destroy']);
Route::get('cart/reduce/{id}',['as' => 'cart.reduce', 'uses' => 'CartController@reduce']);
Route::get('checkout/placeOrder',   ['as' => 'checkout.place', 'uses' => 'CheckoutController@place']);





Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
