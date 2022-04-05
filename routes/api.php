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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('products')->group( function() {
    Route::get('get/{id}', 'ProductController@get');
    Route::get('list', 'ProductController@index');
    Route::get('form', 'ProductController@form');
    Route::get('form/{id}', 'ProductController@form');
    Route::post('save', 'ProductController@store');      
    Route::post('save/{id}', 'ProductController@save');
    Route::delete('delete', 'ProductController@destroy');

});