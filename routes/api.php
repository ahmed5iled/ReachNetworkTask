<?php

use Illuminate\Http\Request;
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

Route::namespace('Api')->group(function () {

    Route::post('login', 'AuthController@login')->name('login');
    Route::post('refresh', 'AuthController@refresh')->name('refresh');
    Route::post('logout', 'AuthController@logout')->name('logout');

    //Ads Routes
    Route::group(['prefix' => 'ads'], function () {
        Route::get('/', 'AdsController@index')->name('ads.index');
        Route::post('store', 'AdsController@store')->name('ads.store');
        Route::group(['prefix' => '{ad}'], function () {
            Route::post('update', 'AdsController@update')->name('ads.update');
            Route::delete('delete', 'AdsController@destroy')->name('ads.destroy');
        });
    });

    //Tags Routes
    Route::group(['prefix' => 'tags'], function () {
        Route::get('/', 'TagsController@index')->name('tags.index');
        Route::post('store', 'TagsController@store')->name('tags.store');
        Route::group(['prefix' => '{tag}'], function () {
            Route::post('update', 'TagsController@update')->name('tags.update');
            Route::delete('delete', 'TagsController@destroy')->name('tags.destroy');
        });
    });
    //Categories Routes
    Route::group(['prefix' => 'categories'], function () {
        Route::get('/', 'CategoriesController@index')->name('categories.index');
        Route::post('store', 'CategoriesController@store')->name('categories.store');
        Route::group(['prefix' => '{category}'], function () {
            Route::post('update', 'CategoriesController@update')->name('categories.update');
            Route::delete('delete', 'CategoriesController@destroy')->name('categories.destroy');
        });
    });
});
