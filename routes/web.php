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
Route::get('/admin/manage-gate-reception-staff', 'Auth\AdminDashboardController@manageGateReceptionStaff')->name('manageGateReceptionStaff');
Route::get('/admin/manage-general-staff', 'Auth\AdminDashboardController@manageGeneralStaff')->name('manageGeneralStaff');

Route::post('/admin/addNewAdmin', 'Auth\AdminDashboardController@addNewAdmin')->name('addNewAdmin');
Route::post('/admin/addNewStaff', 'Auth\AdminDashboardController@addNewStaff')->name('addNewStaff');

Route::put('/admin/approveGate', 'Auth\AdminDashboardController@approveGate')->name('approveGate');
Route::put('/admin/declineGate', 'Auth\AdminDashboardController@declineGate')->name('declineGate');
Route::put('/admin/approveReception', 'Auth\AdminDashboardController@approveReception')->name('approveReception');
Route::put('/admin/declineReception', 'Auth\AdminDashboardController@declineReception')->name('declineReception');



Route::get('/admin/login', 'Auth\AdminLoginController@showAdminLoginForm')->name('showAdminLoginForm');
Route::post('/admin/login', 'Auth\AdminLoginController@adminLogin')->name('adminLogin');
Route::post('/admin/logout', 'Auth\AdminLoginController@adminLogout')->name('adminLogout');

Route::get('/personnel', 'Auth\PersonnelDashboardController@index')->name('personnel');
Route::post('/personnel/submitRequest', 'Auth\PersonnelDashboardController@submitRequest')->name('submitRequest');
Route::delete('/personnel/deleteRequest', 'Auth\PersonnelDashboardController@deleteRequest')->name('deleteRequest');