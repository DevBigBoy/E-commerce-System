<?php

use App\Http\Controllers\Api\Auth\SocialLoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/social-login/{provider}', [SocialLoginController::class, 'socialLogin']);
