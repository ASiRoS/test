<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['as' => 'messages.', 'namespace' => 'Api'], function() {
    Route::get('messages', 'MessageController@index')->name('index');
    Route::get('messages/{id}', 'MessageController@show')->name('show');
    Route::post('messages', 'MessageController@store')->name('store');
    Route::delete('messages/{id}', 'MessageController@destroy')->name('destroy');
});
