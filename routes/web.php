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

Auth::routes();

Route::get('/', 'HomeController@index');

Route::get('/admin/dashboard', 'Auth\AdminDashboardController@index')->name('admin.dashboard');
Route::get('/admin/login', 'Auth\AdminLoginController@showAdminLoginForm')->name('showAdminLoginForm');
Route::post('/admin/login', 'Auth\AdminLoginController@adminLogin')->name('adminLogin');
Route::post('/admin/logout', 'Auth\AdminLoginController@adminLogout')->name('adminLogout');

Route::get('/personnel', 'Auth\PersonnelDashboardController@index')->name('personnel');
Route::post('/personnel/submitRequest', 'Auth\PersonnelDashboardController@submitRequest')->name('submitRequest');
Route::delete('/personnel/deleteRequest/{id}', 'Auth\PersonnelDashboardController@deleteRequest')->name('deleteRequest');