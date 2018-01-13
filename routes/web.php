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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', 'StaticController@home')->name('home');
Route::get('/help', 'StaticController@help')->name('help');
Route::get('/about', 'StaticController@about')->name('about');

Route::get('/share','StaticController@share')->name('share');

Route::get('/show','StaticController@show')->name('show');

Route::resource('users','UsersController');

// Route::get('/users','UsersController@index')->name('users');

// Route::post('/users','UsersController@store')->name('users.store');


