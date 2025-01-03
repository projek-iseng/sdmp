<?php

use App\Http\Controllers\DepartemenController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\master\GajiController;
use App\Http\Controllers\masterData\RegistrasiUsers;
use Illuminate\Http\Request;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('jabatan', JabatanController::class);
Route::apiResource('departemen', DepartemenController::class);



Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('gaji', GajiController::class);
});


Route::prefix('master-data')->group(function () {
    Route::apiResource('pegawai', PegawaiController::class);
    Route::apiResource('registrasiUsers', RegistrasiUsers::class);
});

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('user', [AuthController::class, 'user']);
});
