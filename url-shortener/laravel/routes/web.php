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

Route::get('/','Shortener\\URLController@home');
Route::post('/','Shortener\\URLController@shorten');
Route::get('/{code}','Shortener\\URLController@redirect')
    ->where('code','[A-Za-z0-9]+');
Route::get('/preview/{code}','Shortener\\URLController@show')
    ->where('code','[A-Za-z0-9]+');