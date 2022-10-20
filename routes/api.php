<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\UserController;

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
});
//////////////////////////////// store endpoints////////////////////////////////
