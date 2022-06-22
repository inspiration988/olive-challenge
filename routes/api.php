<?php

use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\TransactionController;
use App\Http\Controllers\Api\v1\UserWalletController;
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

//routes/api.php
Route::group(['prefix' => 'v1'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    //add this middleware to ensure that every request is authenticated
    Route::middleware('CheckToken')->group(function () {
        Route::post('transaction/request', [TransactionController::class, 'request']);
        Route::get('transaction/list', [TransactionController::class, 'list']);
        Route::get('wallet/creditAmount', [UserWalletController::class, 'creditAmount']);
    });
});
