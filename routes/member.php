<?php

use App\Http\Controllers\Member\LogoutController;
use Illuminate\Support\Facades\Route;

Route::livewire('/', 'pages::member.login')->name('login');

Route::middleware('auth:member')->group(function () {

    Route::livewire('/dashboard', 'pages::member.dashboard')->name('dashboard');

    Route::livewire('/deposits', 'pages::member.deposits.index')->name('deposits.index');
    Route::livewire('/deposits/{deposit}', 'pages::member.deposits.show')->name('deposits.show');

    Route::livewire('/transactions', 'pages::member.transactions.index')->name('transactions.index');
    Route::livewire('/transactions/{transaction}', 'pages::member.transactions.show')->name('transactions.show');

    Route::livewire('/wastes', 'pages::member.wastes.index')->name('wastes.index');

    Route::post('/logout', LogoutController::class)
        ->name('logout');
});
