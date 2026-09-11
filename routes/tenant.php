<?php

use Illuminate\Support\Facades\Route;

Route::livewire('/tenants', 'pages::tenants.index')->name('tenants.index');
Route::livewire('/onboarding', 'pages::onboarding')->name('onboarding');

Route::middleware(['tenant'])->group(function () {
    Route::livewire('/dashboard', 'pages::dashboard')->name('dashboard');
    Route::livewire('/members', 'pages::members.index')->name('members.index');
    Route::livewire('/cash', 'pages::cash.index')->name('cash.index');
    Route::livewire('/users', 'pages::users.index')->name('users.index');
    Route::livewire('/settings', 'pages::settings')->name('settings');

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
});
