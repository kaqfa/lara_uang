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
Route::get('/transaction/add', 'TransactionController@add')->name('add-trans');
Route::post('/transaction/add', 'TransactionController@add')->name('add-trans.post');
Route::get('/transaction/show', 'TransactionController@show')->name('show-trans');
Route::get('/profile', 'HomeController@index')->name('edit-profile');