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
    Route::get('/banks', 'BanksController@index')->name('admin.bank');
    Route::post('/banks', 'BanksController@store')->name('admin.bank');
    Route::get('/banks/{id}', 'BanksController@edit')->name('admin.bank.detail');

    Route::post('/banks/{id}', 'BanksController@update')->name('admin.bank.edit');
});

Route::prefix('admin')->group(function() {
    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\LoginController@login');
});
