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
    return 'Working!';
//    $order = App\Order::first();
//    FailedOrders::dispatch($order);

//    return 'Finished';

    // $error = \App\InternalError::first();
    // dd(json_decode($error->error_body,1));
    // return json_decode();
});
Route::get('/test', 'ApiController@test');
Route::get('/bol', 'ApiController@createBOL');

Route::get('/all-products',function (){});
Route::any('/create/product', 'ApiController@createNewProduct');
Route::any('/easypost/order', 'ApiController@easyPostOrder');

Route::get('/products', 'ApiController@getProducts');

Route::get('/orders', 'ApiController@getDailyOrders');

Route::any('/authenticate', 'ApiController@authenticate');

Route::post('/orders/new', 'ApiController@createFulfillmentOrder');
Route::any('/orders/update', 'ApiController@updateOrder');
