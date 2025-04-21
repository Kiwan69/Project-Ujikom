<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AcaraController;
use App\Http\Controllers\Api\StadionController;
use App\Http\Controllers\Api\TiketController;
use App\Http\Controllers\Api\PenggunaController;
use App\Http\Controllers\Api\PemesananController;
use App\Http\Controllers\Api\PembayaranController;



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

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
});

Route::get('/acaras', [AcaraController::class, 'index']);
Route::post('/acaras', [AcaraController::class, 'store']);

Route::apiResource('stadions', StadionController::class);
Route::apiResource('acaras', AcaraController::class);
Route::apiResource('tikets', TiketController::class);
Route::apiResource('penggunas', PenggunaController::class);
Route::apiResource('pemesanans', PemesananController::class);
Route::apiResource('pembayarans', PembayaranController::class);
