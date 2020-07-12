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
    Route::get('/register', 'MembersController@create')->name('member.register');
    Route::post('/register', 'MembersController@store')->name('member.register');
    Route::post('/login', 'MembersController@auth')->name('members.login');
});

Route::group(['middleware' => ['memberauth'], 'prefix' => 'members'], function() {
    Route::get('/list-order', 'OrderController@listOrder')->name('member.list.order');
    Route::get('/profile', 'MembersController@viewprofile')->name('member.profile');
    Route::post('/profile', 'MembersController@updateprofile')->name('member.profile');

    Route::get('/logout', 'MembersController@logout')->name('member.logout');
    Route::get('/vendor/{slug}', 'VendorController@showVendor')->name('member.vendor');

    Route::get('/check/vendor', 'VendorController@checkUserHave')->name('member.check.vendor');

    Route::get('/create-vendor', 'VendorController@create')->name('members.create.vendor');
    Route::post('/create-vendor', 'VendorController@store')->name('members.create.vendor');
    Route::get('/manage-vendor', 'VendorController@manage')->name('members.manage.vendor');
    Route::post('/manage-vendor/{id}/edit', 'VendorController@edit')->name('vendor.edit');

    Route::post('/manage-vendor/{vendor_id}/bank', 'VendorController@editBankAccount')->name('vendor.account_bank');

    Route::post("/manage-vendor/real-wedding", 'VendorController@storeAlbum')->name('vendor.add.album');
    Route::delete("/manage-vendor/real-wedding/{id}", 'VendorController@destroyAlbum')->name('vendor.delete.album');

    Route::post("/manage-vendor/add-photo/album", 'VendorController@storePhotoAlbum')->name("vendor.add.photo.album");
    Route::get("/manage-vendor/list/album", 'VendorController@listalbum')->name('vendor.list.album');

    Route::post("/manage-vendor/package/{vendor_id}", 
    'PackageController@store')->name('vendor.add.package');
    Route::delete("/manage-vendor/package/{vendor_id}", 'PackageController@destroy')->name('vendor.delete.package');
    Route::get("/manage-vendor/list/package", 'PackageController@list')->name('vendor.list.package');

    Route::get("/manage-vendor/list/promo/{vendor_id}", 'PromoController@list')->name('vendor.list.promo');
    Route::post("/manage-vendor/promo/add", 'PromoController@store')->name('vendor.promo.add');
    Route::delete("/manage-vendor/promo/{id}", 'PromoController@destroy')->name('vendor.promo.delete');

    Route::get("/manage-vendor/{id}/orders", 'OrderController@listOrderVendor')->name('vendor.list.order');
    Route::put("/manage-vendor/completepayment/orders/{id}", 'OrderController@completePaymentCustomer')->name('member.complete.fullpayment');
    Route::get("/manage-vendor/{id}/orders/{order_id}", 'OrderController@orderDetail')->name('vendor.order.detail');

    Route::post("/orders", "OrderController@store")->name('member.order');
    Route::post("/orders/{id}/payment", "PaymentController@store")->name('member.upload.struct');
    Route::put("/orders/{id}/confirm", "OrderController@completeOrder")->name('member.complete.order');

    Route::get('/package/{id}', 'PackageController@show')->name('package.detail');
});