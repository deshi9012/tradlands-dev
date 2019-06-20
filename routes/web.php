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


use App\Jobs\FailedOrders;

Route::get('/', function () {
//    $order = App\Order::first();
//    FailedOrders::dispatch($order);
//
//    return 'Finished';

    return \App\InternalError::first();
});
Route::get('/products', 'ApiController@getProducts');

Route::get('/orders', 'ApiController@getDailyOrders');

Route::any('/authenticate', 'ApiController@authenticate');

Route::post('/orders/new', 'ApiController@createOrder');
Route::any('/orders/update', 'ApiController@updateOrder');