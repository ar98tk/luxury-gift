<?php
namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'auth:sanctum'], function () {
    //Auth
    Route::get('get-info', [AuthController::class, 'getInfo']);
    Route::get('logout',   [AuthController::class, 'logout']);
});
//Auth Routes
Route::post('login',          [AuthController::class, 'login']);
Route::post('register',       [AuthController::class, 'register']);

//Categories
Route::get('get-categories', [CategoryController::class, 'getCategories']);
Route::get('get-category-products', [CategoryController::class, 'getCategoryProducts']);

//Brands
Route::get('get-brands', [BrandController::class, 'getBrands']);
Route::get('get-brand-products', [BrandController::class, 'getBrandProducts']);

Route::get('get-settings', [SettingsController::class, 'getSettings']);
