<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1'], function () {
    Route::get('orders/today', 'OrderController@getOrdersToday');
    Route::get('check/free', 'OrderController@checkOrder');
    Route::post('orders/make', 'OrderController@makeOrder');

    Route::get('get/gallery', 'GetDataController@getGallery');
    Route::get('get/page', 'GetDataController@getPageData');
    Route::post('send/ask', 'OrderController@sendQuestion');
});
