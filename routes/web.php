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

Route::resource('users','UsersController');

Route::get('login','SessionsController@create')->name('login');

Route::post('login','SessionsController@stroe')->name('login');

Route::get('show','SessionsController@show')->name('show');

Route::delete('logout','SessionsController@destory')->name('logout');
