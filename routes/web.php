<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Socialite\GithubAuthController;
use App\Http\Controllers\Socialite\SocialLogin;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/auth/{provider}/redirect', [SocialLogin::class, 'redirect'])->name('social.redirect');
Route::get('/auth/{provider}/callback', [SocialLogin::class, 'callback']);
