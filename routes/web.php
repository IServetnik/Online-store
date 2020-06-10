<?php

use Illuminate\Support\Facades\Route;


Route::resource('/', 'MainController')->names('main');


//Cayegories
Route::namespace('Category')->group(function () {
    Route::group(['prefix' => 'men', 'as' => 'men.'], function () {
        Route::get('/', 'MenController@getAll')->name('all');
        Route::get('/{type}', 'MenController@getByType')->name('type');
    });

    Route::group(['prefix' => 'women', 'as' => 'women.'], function () {
        Route::get('/', 'WomenController@getAll')->name('all');
        Route::get('/{type}', 'WomenController@getByType')->name('type');
    });

    Route::group(['prefix' => 'kids', 'as' => 'kids.'], function () {
        Route::get('/', 'KidsController@getAll')->name('all');
        Route::get('/{type}', 'KidsController@getByType')->name('type');
    });
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
