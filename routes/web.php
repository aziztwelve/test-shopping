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

//Route::get('/', 'UserController@index');
Route::get('/', 'ProductController@index');
Route::get('/cart/{id}', 'ProductController@storeCart')->name('store_cart');
Route::get('/cart', 'ProductController@cart')->name('cart');
Route::delete('/cart/{id}', 'ProductController@deleteCart')->name('cart_delete');
Route::post('/order', 'OrderController@store')->name('order_create');

Route::post('/product', 'ProductController@store');
Route::delete('/product/{id}', 'ProductController@destroy');


