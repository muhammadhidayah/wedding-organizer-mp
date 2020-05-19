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

Route::prefix('members')->group(function() {
    Route::get('/', 'MembersController@index')->name('member.home');
    Route::post('/login', 'MembersController@auth')->name('members.login');
});

Route::group(['middleware' => ['memberauth'], 'prefix' => 'members'], function() {
    Route::get('/vendor/{slug}', function($slug) {
        return "Vendor Page " . $slug;
    })->name('member.vendor');

    Route::get('/create-vendor', 'VendorController@create')->name('members.create.vendor');
    Route::post('/create-vendor', 'VendorController@store')->name('members.create.vendor');
    Route::get('/manage-vendor', 'VendorController@manage')->name('members.manage.vendor');
    Route::post("/manage-vendor/real-wedding", 'VendorController@storeAlbum')->name('vendor.add.album');
    Route::post("/manage-vendor/add-photo/album", 'VendorController@storePhotoAlbum')->name("vendor.add.photo.album");
    Route::get("/manage-vendor/list/album", 'VendorController@listalbum')->name('vendor.list.album');

    Route::post("/manage-vendor/package/{vendor_id}", 'PackageController@store')->name('vendor.add.package');
    Route::get("/manage-vendor/list/package", 'PackageController@list')->name('vendor.list.package');

    Route::get("/manage-vendor/list/promo/{vendor_id}", 'PromoController@list')->name('vendor.list.promo');
});