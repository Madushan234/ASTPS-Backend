<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Api\CustomerAuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


/**
 * Customer app auth routes
 */

Route::prefix('customer')->group(function () {
    Route::post('/register',  [CustomerAuthController::class, 'createCustomer']);
    Route::post('/social-auth',  [CustomerAuthController::class, 'socialAuth'])->middleware('validateSocialAuth:["customer"]');
});

Route::prefix('customer')->middleware('checkUserRole:customer')->group(function () {
    Route::post('/login',  [CustomerAuthController::class, 'login']);
    Route::post('/forgot-password',  [CustomerAuthController::class, 'sendResetPasswordLink']);
});
