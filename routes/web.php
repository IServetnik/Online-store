<?php

use Illuminate\Support\Facades\Route;


Route::get('/', 'MainController@index')->name('main');
Route::get('/home', 'HomeController@index')->name('home');


Route::resource('/product', 'ProductController')->names('product');
Route::resource('/type', 'TypeController')->names('type');


//Categories
Route::namespace('Category')->group(function () {
    Route::group(['prefix' => 'men', 'as' => 'men.'], function () {
        Route::get('/', 'MenController@showAll')->name('all');
        Route::get('/{type}', 'MenController@showByType')->name('type');
    });

    Route::group(['prefix' => 'women', 'as' => 'women.'], function () {
        Route::get('/', 'WomenController@showAll')->name('all');
        Route::get('/{type}', 'WomenController@showByType')->name('type');
    });

    Route::group(['prefix' => 'kids', 'as' => 'kids.'], function () {
        Route::get('/', 'KidsController@showAll')->name('all');
        Route::get('/{type}', 'KidsController@showByType')->name('type');
    });
});


//Cart
Route::prefix('cart')->group(function () {
    Route::get('/', 'CartController@index')->name('cart');
    Route::post('/add', 'CartController@add')->name('cart.add');
});

Auth::routes();