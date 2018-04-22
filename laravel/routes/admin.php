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

Route::resource('/manager', 'Admin\ProjectManagerController');

Route::get('/register', 'Auth\AdminRegisterController@showRegistrationForm')->name('register');
Route::post('/register', 'Auth\AdminRegisterController@register')->name('register.submit');
Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\AdminLoginController@login')->name('login.submit');
Route::get('/', 'Admin\HomeController@dashboard')->name('dashboard');
Route::get('/logout', 'Auth\AdminLoginController@logout')->name('logout');

// Password reset routes
Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset');
Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('password.reset');

Route::view('/blank', 'admin.blank')->name('blank');
