<?php

use Illuminate\Support\Facades\Auth;
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
Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'HomeController@home')->name('home');
    Route::group(['middleware' => 'is_admin'], function () {
        Route::group(['prefix' => 'admin', 'as' => 'admin.' ], function () {
            Route::resource('users', 'UserController', ['except' => ['show']]);
            Route::get('/', 'HomeController@admin');
            Route::get('/inquiries', 'MedicamentInquiryController@list');
            Route::get('/funds', 'FundController@index')->name('funds.index');
            Route::get('/warehouses', 'ProductController@index')->name('warehouses.index');
        });
    });

    Route::resource('funds', 'FundController');

    Route::resource('inquiries', 'MedicamentInquiryController');

    // Products
    Route::resource('products', 'ProductController', ['except' => ['index']]);

    Route::get('/my_warehouse', 'ProductController@myWarehouse')->name('products.my_warehouse');
    Route::get('/all_warehouses', 'ProductController@allWarehouses')->name('products.all_warehouses');

    Route::post('products/datatable', 'ProductController@datatable')->name('products.datatable');
    Route::post('all_warehouses/datatable', 'ProductController@allWarehousesDatatable')->name('products.all_warehouses.datatable');

    Route::get('/products/{product}/changeQuantity', 'ProductController@changeQuantity')->name('products.changeQuantity');
    Route::post('/products/{productId}/storeQuantity', 'ProductController@storeQuantity')->name('products.storeQuantity');

    
    // Answers
    Route::get('/answer/create', 'ProductAnswerController@create')->name('answer.form.create');
    Route::post('/inquiries/{inquiryId}/answer/store', 'AnswerController@store')->name('answer.store');
    Route::get('answer/{id}/accept_answer', 'AnswerController@acceptAnswer')->name('answer.accept_answer');
    Route::delete('answer/{id}/delete', 'AnswerController@destroy')->name('answer.destroy');
});
