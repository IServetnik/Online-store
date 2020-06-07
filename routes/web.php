<?php

use Illuminate\Support\Facades\Route;


Route::get('/', 'MainController@index')->name('main');


Route::namespace('Category')->group(function () {
    Route::group(['prefix' => 'men', 'as' => 'men.'], function () {
        Route::get('/', 'MenController@index')->name('index');
    });

    Route::group(['prefix' => 'women', 'as' => 'women.'], function () {
        Route::get('/', 'WomenController@index')->name('index');
    });

    Route::group(['prefix' => 'kids', 'as' => 'kids.'], function () {
        Route::get('/', 'KidsController@index')->name('index');
    });
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
