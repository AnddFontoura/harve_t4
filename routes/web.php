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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')->group( function() {
    Route::prefix('category')->group( function() {
        Route::get('list', 'CategoryController@index');
        Route::get('form', 'CategoryController@form');
        Route::get('form/{id}', 'CategoryController@form');
        Route::post('save', 'CategoryController@save');      
        Route::post('save/{id}', 'CategoryController@save');
        Route::delete('delete', 'CategoryController@destroy');

    });
    
});