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

// Product
Route::get('/product/{id}', 'ProductController@index');


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
    });
});
