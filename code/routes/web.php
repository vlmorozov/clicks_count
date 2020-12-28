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

Route::get('/', 'IndexController@index');


Route::get('/success/{idClick}', 'IndexController@success')->where('idClick', '[A-Za-z0-9]+')->name('success');
Route::get('/error/{idClick}', 'IndexController@error')->where('idClick', '[A-Za-z0-9]+')->name('error');
