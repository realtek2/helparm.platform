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
    Route::get('/', 'HomeController@home');
    Route::group(['middleware' => 'is_admin'], function () {
        Route::group(['prefix' => 'admin', 'as' => 'admin.' ], function () {
            Route::resource('users', 'UserController', ['except' => ['show']]);
            Route::get('/', 'HomeController@admin');
            Route::get('/inquiries', 'MedicamentInquiryController@list');
            Route::get('/funds', 'FundController@index')->name('funds.index');
            Route::get('/warehouses', 'ProductController@index')->name('warehouses.index');
        });
    });

    Route::resource('funds', 'FundController', ['except' => ['show']]);

    Route::resource('inquiries', 'MedicamentInquiryController');

    Route::resource('products', 'ProductController');
    Route::get('/answer/create', 'ProductController@create')->name('answer.form.create');
    Route::post('/answer/store', 'ProductController@store')->name('answer.store');

    Route::post('/inquiries/{inquiryId}/answer/store', 'ProductAnswerController@store')->name('asnwer.store');
});
