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

Route::get('/', 'FrontEnd\FrontController@index');
Route::get('/projects', 'FrontEnd\FrontController@getProjects');
Route::get('/employees', 'FrontEnd\FrontController@getEmployees');


Route::get('/users/logout', 'Auth\LoginController@userLogout')->name('user.logout');
