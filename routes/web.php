<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\LogoutController;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return view('welcome');
});

Route::post('/logout', LogoutController::class)->name('logout');

Route::get('/auth/redirect', [AuthController::class, 'redirectToViaAccount'])->name('auth.redirect');
Route::get('/auth/callback', [AuthController::class, 'handleCallback'])->name('auth.callback');
Route::get('/login', fn () => redirect()->route('auth.redirect'))->name('login');
Route::get('/register', fn () => redirect()->route('auth.redirect'))->name('register');

Route::middleware(['auth'])->group(function()
{
    Route::livewire('/tenants', 'pages::tenants.index')->name('tenants.index');
    Route::livewire('/onboarding', 'pages::onboarding')->name('onboarding');
});

Route::middleware(['auth', 'tenant'])->group(function () 
{
    Route::livewire('/settings', 'pages::settings')->name('settings');

    Route::livewire('/dashboard', 'pages::dashboard')->name('dashboard');
	
    Route::livewire('/members', 'pages::members.index')->name('members.index');

    Route::livewire('/wastes', 'pages::wastes.index')->name('wastes.index');
    Route::livewire('/wastes/{waste}', 'pages::wastes.show')->name('wastes.show');

    Route::livewire('/deposits', 'pages::deposits.index')->name('deposits.index');
    Route::livewire('/deposits/{deposit}', 'pages::deposits.show')->name('deposits.show');

    Route::livewire('/lots', 'pages::lots.index')->name('lots.index');
    Route::livewire('/lots/{lot}', 'pages::lots.show')->name('lots.show');

    Route::livewire('/sales', 'pages::sales.index')->name('sales.index');
    Route::livewire('/sales/{sale}', 'pages::sales.show')->name('sales.show');

    Route::livewire('/withdrawals', 'pages::withdrawals.index')->name('withdrawals.index');
    Route::livewire('/withdrawals/{withdrawal}', 'pages::withdrawals.show')->name('withdrawals.show');

    Route::livewire('/users', 'pages::users.index')->name('users.index');
});

Route::prefix('member')->name('member.')->group(function () 
{
    Route::livewire('/', 'pages::member.login')->name('login');

    Route::middleware('auth:member')->group(function () {

        Route::livewire('/dashboard', 'pages::member.dashboard')->name('dashboard');

        Route::post('/logout', \App\Http\Controllers\Member\LogoutController::class)
            ->name('logout');

    });
});
