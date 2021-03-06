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

// Route::get('/', function () {
// });
Route::get('/', 'HomeController@index');
Route::get('/product/category/{categories}', 'HomeController@product_category');

// Product
Route::get('/product/{id}', 'ProductController@index');
Route::post('/get_city', 'ProductController@get_city');
Route::post('/get_courier', 'ProductController@get_courier');
Route::post('/product/order', 'ProductController@order');


// Admin
Route::group(['prefix' => '/admin'], function () {
    Route::get('/login', 'Admin\LoginController@index');
    Route::post('/login_process', 'Admin\LoginController@process');

    Route::group(['middleware' => 'checkAdmin'], function () {
        Route::get('/logout', 'Admin\LoginController@logout');

        // Admin Home
        Route::get('/home', 'Admin\HomeController@index');
        Route::post('/home/add_banner', 'Admin\HomeController@add_banner');
        Route::get('/home/edit/{id}', 'Admin\HomeController@edit');
        Route::post('/home/edit/process', 'Admin\HomeController@edit_process');
        Route::post('/home/delete_banner', 'Admin\HomeController@delete_banner');

        // Admin Product
        Route::get('/product', 'Admin\ProductController@index');
        Route::get('/product/add_product', 'Admin\ProductController@add');
        Route::post('/product/add_product_process', 'Admin\ProductController@add_process');
        Route::post('/product/delete_product', 'Admin\ProductController@delete_process');
        Route::get('/product/edit/{id}', 'Admin\ProductController@edit');
        Route::post('/product/edit_product_process', 'Admin\ProductController@edit_process');

        // Admin Order
        Route::get('/order', 'Admin\OrderController@index');
        Route::get('/order/data/{type}', 'Admin\OrderController@data');
        Route::post('/order/accept_order', 'Admin\OrderController@accept');
        Route::post('/order/cancel_order', 'Admin\OrderController@cancel');
        Route::post('/order/finish_order', 'Admin\OrderController@finish');
        Route::get('/order/history', 'Admin\OrderController@history');
        Route::get('/order/history/data/{type}', 'Admin\OrderController@history_data');
        Route::get('/order/detail/{id}/{status}', 'Admin\OrderController@detail');

        // General Setting
        Route::get('/setting', 'Admin\SettingController@index');
        Route::post('/setting/get_city_admin', 'Admin\SettingController@get_city');
        Route::post('/setting/general_setting', 'Admin\SettingController@general_setting');
    });
});
