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

/* Route::get('/', function () {
    return view('store.products');
}); */

Route::post('/createorder', 'OrderController@createOrder');

Route::get('/orderpayment/{reference_id}', 'OrderController@getOrderReferenceId');

Route::get('/order', 'OrderController@viewOrder');

Route::get('/userorders', 'OrderController@userOrders');

Route::post('/createorder', 'OrderController@createOrder');

Route::get('/', 'ProductsController@viewProducts');

Route::get('/productos', 'ProductsController@viewProducts');

Route::get('/product/{id_product}', 'ProductsController@viewProduct')->name('product');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

