<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LogoutController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/logout', LogoutController::class)->name('logout');

Route::get('/auth/redirect', [AuthController::class, 'redirectToViaAccount'])->name('auth.redirect');
Route::get('/auth/callback', [AuthController::class, 'handleCallback'])->name('auth.callback');

Route::livewire('/login', 'pages::login')->name('login');
Route::get('/register', fn() => redirect()->route('auth.redirect'))->name('register');

Route::middleware(['auth'])->group(function () {
    require __DIR__ . '/tenant.php';
});

Route::prefix('member')->name('member.')->group(function () {
    require __DIR__ . '/member.php';
});
