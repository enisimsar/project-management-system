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

Route::resource('/task', 'ProjectManager\TaskController');
Route::resource('/project', 'ProjectManager\ProjectController');
Route::resource('/employee', 'ProjectManager\EmployeeController');

Route::post('/project-task', 'ProjectManager\ProjectTaskController@store')->name('project.task.store');
Route::delete('/project-task', 'ProjectManager\ProjectTaskController@destroy')->name('project.task.destroy');

Route::post('/employee-task', 'ProjectManager\EmployeeTaskController@store')->name('employee.task.store');
Route::delete('/employee-task', 'ProjectManager\EmployeeTaskController@destroy')->name('employee.task.destroy');

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('/', 'ProjectManager\HomeController@index')->name('dashboard');

Route::view('/blank', 'manager.blank')->name('blank');
