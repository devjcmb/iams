<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IpAddressController;
use App\Http\Controllers\AuditHistoryController;

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

Route::group(['prefix' => 'auth'], function() {
    Route::post('register', [AuthController::class, 'register']); 
    Route::post('login', [AuthController::class, 'login']);
});

Route::group(['middleware' => ['auth:api']], function () {

    Route::group(['prefix' => 'auth'], function() {
        Route::post('logout', [AuthController::class, 'logout']);
    });

    Route::group(['prefix' => 'ip-addresses'], function() {
        Route::get('/', [IpAddressController::class, 'index']);
        Route::post('/', [IpAddressController::class, 'create']);
        Route::post('{id}', [IpAddressController::class, 'update']);
    });

    Route::group(['prefix' => 'audit-history'], function() {
        Route::get('/', [AuditHistoryController::class, 'index']);
    });

});
