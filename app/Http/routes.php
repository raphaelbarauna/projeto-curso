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

Route::group(['prefix'=>'admin','where'=> ['id'=> '[0-9]+']], function()
{
Route::get('categories',['as'=>'categories', 'uses'=>'AdminCategoriesController@index']);
Route::post('categories',['as'=>'categories.store', 'uses'=>'AdminCategoriesController@store']);
Route::get('categories/create',['as'=>'categories.create', 'uses'=>'AdminCategoriesController@create']);
Route::get('categories/{id}/destroy',['as'=>'categories.destroy', 'uses'=>'AdminCategoriesController@destroy']);
Route::get('categories/{id}/edit',['as'=>'categories.edit', 'uses'=>'AdminCategoriesController@edit']);
Route::put('categories/{id}/update',['as'=>'categories.update', 'uses'=>'AdminCategoriesController@update']);

Route::get('products',['as'=>'products', 'uses'=>'AdminProductsController@index']);
Route::post('products',['as'=>'products.store', 'uses'=>'AdminProductsController@store']);
Route::get('products/create',['as'=>'products.create', 'uses'=>'AdminProductsController@create']);
Route::get('products/{id}/destroy',['as'=>'products.destroy', 'uses'=>'AdminProductsController@destroy']);
Route::get('products/{id}/edit',['as'=>'products.edit', 'uses'=>'AdminProductsController@edit']);
Route::put('products/{id}/update',['as'=>'products.update', 'uses'=>'AdminProductsController@update']);
});



Route::get('/', 'WelcomeController@index');

//Route::get('categories', 'AdminCategoriesController@categoria');

//Route::get('products', 'AdminProductsController@produto');
	
	


Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
