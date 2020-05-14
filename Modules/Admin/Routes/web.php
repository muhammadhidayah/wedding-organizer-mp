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

// Route::prefix('admin')->group(function() {
//     Route::get('/', 'AdminController@index');
// });
Route::group(['middleware' => ['adminauth'], 'prefix' => 'admin'], function()
{
    Route::get('/', 'AdminController@index')->name('admin.index');
    Route::post('/', 'ListAdminController@store')->name('admin.add');
    Route::delete('/{id}', 'ListAdminController@destroy')->name('admin.delete');

    Route::get('/profile', 'ProfileController@index')->name('admin.profile');
    Route::post('/profile', 'ProfileController@store')->name('admin.profile');

    Route::get('/{id}/edit', 'ListAdminController@edit')->name('admin.edit');    
    Route::post('/{id}/edit', 'ListAdminController@update')->name('admin.update');

    Route::get('/banks', 'BanksController@index')->name('admin.bank');
    Route::post('/banks', 'BanksController@store')->name('admin.bank');
    Route::get('/banks/{id}', 'BanksController@edit')->name('admin.bank.detail');
    Route::post('/banks/{id}', 'BanksController@update')->name('admin.bank.edit');

    Route::get('/list-admin', 'ListAdminController@index')->name('admin.listadmin');
    Route::get('/list-customer', 'CustomersController@index')->name('admin.listcustomer');

    Route::delete('/{id}/customer', 'CustomersController@destroy')->name('admin.customer.delete');

    Route::get('/order', 'OrderController@index')->name('admin.order');
    Route::get('/order/{id}', 'OrderController@detail')->name('admin.detail_order');
    Route::put('/order/{id}', 'OrderController@confirmation')->name('admin.order.confirmation');


});

Route::prefix('admin')->group(function() {
    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\LoginController@login');
});
