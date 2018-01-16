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

Route::get('/login','SessionsController@create')->name('login');
Route::post('/login','SessionsController@stroe')->name('login');

// 退出登录路由
Route::delete('logout', 'SessionsController@destroy')->name('logout');


Route::get('/share','StaticController@share')->name('share');

Route::get('/show','StaticController@show')->name('show');

Route::resource('users','UsersController');

Route::get('signup/confirm/{token}','UsersController@confirmEmail')->name('confirm_email');

/*
*密码重置路由
*/
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
