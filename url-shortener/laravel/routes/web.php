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

Route::group(['namespace'=>'Shortener'],function(){
    Route::get('/','URLController@home')->name('home');
    Route::post('/','URLController@shorten')->name('url-create');
    Route::get('/{code}','URLController@redirect')
        ->where('code','[A-Za-z0-9]+')
        ->name('url-redirect');
    Route::get('/preview/{code}','URLController@show')
        ->where('code','[A-Za-z0-9]+')
        ->name('url-preview');
});
