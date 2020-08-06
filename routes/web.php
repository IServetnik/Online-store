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

//Reviews
Route::group(['prefix' => 'review', 'as' => 'review.'], function () {
    Route::post('/', 'ReviewController@store')->name('store');
    Route::patch('/{id}', 'ReviewController@update')->name('update');
    Route::delete('/{id}', 'ReviewController@destroy')->name('destroy'); 
});

//Cart
Route::group(['prefix' => 'cart', 'as' => 'cart.'], function () {
    Route::get('/', 'CartController@index')->name('index');
    Route::post('/', 'CartController@add')->name('add');
    Route::post('/delete/{name}', 'CartController@delete')->name('delete');
    Route::post('/increase/{name}', 'CartController@increaseQuantity')->name('increaseQuantity');
    Route::post('/decrease/{name}', 'CartController@decreaseQuantity')->name('decreaseQuantity');
});

Auth::routes();