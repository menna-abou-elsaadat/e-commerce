<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserPurchasesController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//////////////////////////////// user endpoints////////////////////////////////
Route::prefix('/user')->group(function () {
    Route::post('/create', [UserController::class, 'create']);
});
//////////////////////////////// user endpoints////////////////////////////////

//////////////////////////////// store endpoints////////////////////////////////
Route::prefix('/store')->group(function () {
    Route::get('/{merchant_id}', [StoreController::class, 'index']);
    Route::post('/create', [StoreController::class, 'create']);
    Route::post('/add_product', [StoreController::class, 'addProductToStore']);
    Route::get('/show_store_products/{store_id}', [StoreController::class, 'showStoreProducts']);
    Route::post('/show_store_product', [StoreController::class, 'showStoreProduct']);
});
//////////////////////////////// store endpoints////////////////////////////////

//////////////////////////////// user purchase endpoints////////////////////////////////
Route::prefix('/user_purchase')->group(function () {
    Route::post('/create_user_purchase', [UserPurchasesController::class, 'createUserPurchase']);
});
//////////////////////////////// user purchase endpoints////////////////////////////////
