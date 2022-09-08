<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(['middleware' => 'guestAdmin'], function () {
    Route::get('/', [Auth\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('admin', [Auth\LoginController::class, 'login'])->name('login.post');
});

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {
    Route::group(['middleware' => 'adminAuth'], function () {
        // Orders
        Route::put('updateMainInfo', [OrderController::class, 'updateMainInfo'])->name('updateMainInfo');
        Route::post('addMoreProducts', [OrderController::class, 'addMoreProducts'])->name('addMoreProducts');
        Route::delete('destroyOrderItem/{id}', [OrderController::class, 'destroyOrderItem'])->name('destroyOrderItem');
        Route::get('waiting-orders',[OrderController::class,'waiting'])->name('waiting-orders');
        Route::get('confirmed-orders',[OrderController::class,'confirmed'])->name('confirmed-orders');
        Route::get('shipping-orders',[OrderController::class,'shipping'])->name('shipping-orders');
        Route::get('deliverer-orders',[OrderController::class,'deliverer'])->name('deliverer-orders');
        Route::get('cancelled-orders',[OrderController::class,'cancelled'])->name('cancelled-orders');
        Route::post('review-orders',[OrderController::class,'review'])->name('review-orders');
        Route::post('submit-orders/{values} ',[OrderController::class,'submit'])->name('submit-orders');
        Route::get('print-order/{id}',[OrderController::class, 'print'])->name('print-order');
        Route::resource('orders', OrderController::class);

        Route::resource('admins',      AdminController::class)->except('create', 'show','edit');
        Route::resource('colors',      ColorController::class)->except('create', 'show','edit');
        Route::resource('sizes',       SizeController::class)->except('create', 'show','edit');
        Route::resource('categories',  CategoryController::class)->except('create', 'show','edit');
        Route::resource('brands',      BrandController::class)->except('create', 'show','edit');
        Route::resource('messages',    MessageController::class)->except('create', 'edit');
        Route::resource('users',       UserController::class);
        Route::resource('products',       ProductController::class);
        Route::resource('cities',      CityController::class)->except('create', 'show','edit');

        Route::delete('addresses/destroy/{id}',[UserController::class, 'destroyAddress'])->name('address.destroy');
        Route::post('addresses/store',[UserController::class, 'storeAddress'])->name('address.store');

        Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
        Route::post('settings', [SettingsController::class, 'update'])->name('settings.update');

        Route::get('/home', function () {
            return view('admin.index');
        })->name('home');

        Route::get('/mode', function () {
            \Illuminate\Support\Facades\Session::get('mode') == 'Dark' ? \Illuminate\Support\Facades\Session::put('mode', 'Light') : \Illuminate\Support\Facades\Session::put('mode', 'Dark');
            return redirect()->back();
        })->name('admin.mode');
        Route::post('logout', [Auth\LoginController::class, 'logout'])->name('logout.admin');
    });
});
