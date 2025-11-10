<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

/** Auth */
Route::middleware('guest')->group(function (){
    Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'index'])->name('login');
    Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'store'])->name('login.store');
    Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'index'])->name('register');
    Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'store'])->name('register.store');
});

Route::get('logout', App\Http\Controllers\Auth\LogoutController::class)->name('logout')->middleware('auth');

Route::get('/email/verify', function () {
    return view('pages.auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    $user = $request->user();

    if($user->hasRole('admin')){
        return to_route('admin.dashboard');
    }if($user->hasRole('creator')){
        return to_route('creator.dashboard');
    }if($user->hasRole('user')){
        return to_route('landing-page');
    }
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return response()->json([
        'status' => 'success',
        'message' => 'Virifikasi ulang email berhasil di kirim'
    ]);
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
