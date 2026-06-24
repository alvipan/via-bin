<?php

use App\Livewire\Dashboard;
use Illuminate\Support\Facades\Route;

use App\Livewire\Onboarding\Index as OnboardingIndex;
use App\Livewire\Tenant\Index as TenantIndex;
use App\Livewire\Tenant\Create as TenantCreate;
use App\Livewire\Tenant\Edit as TenantEdit;
use App\Livewire\Sales\Index as SalesIndex;
use App\Livewire\Sales\Create as SalesCreate;
use App\Livewire\Sales\Show as SalesShow;
use App\Livewire\Withdrawal\Index as WithdrawalIndex;
use App\Livewire\Withdrawal\Show as WithdrawalShow;
use App\Livewire\Withdrawal\Approve as WithdrawalApprove;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TenantController;

Route::get('/', Dashboard::class)
	->middleware(['auth', 'tenant'])
	->name('dashboard');

Route::get('/auth/redirect', [AuthController::class, 'redirectToViaAccount'])->name('auth.redirect');
Route::get('/auth/callback', [AuthController::class, 'handleCallback'])->name('auth.callback');
Route::get('/login', fn () => redirect()->route('auth.redirect'))->name('login');

Route::middleware(['auth'])->group(function () {
	Route::get('/onboarding', OnboardingIndex::class)->name('onboarding');
	Route::get('/tenants', TenantIndex::class)->name('tenants.index');
	Route::get('/tenants/create', TenantCreate::class)->name('tenants.create');
	Route::get('/tenants/{tenant}/edit', TenantEdit::class)->name('tenants.edit');
	Route::get('/tenants/{tenant}', App\Livewire\Tenant\Show::class)->name('tenants.show');
	Route::post('/tenants/switch/{tenant}', [TenantController::class, 'switch'])->name('tenants.switch');
	Route::get('/sales', SalesIndex::class)->name('sales.index');
	Route::get('/sales/create', SalesCreate::class)->name('sales.create');
	Route::get('/sales/{sale}', SalesShow::class)->name('sales.show');
	Route::get('/deposits', App\Livewire\Deposit\Index::class)->name('deposits.index');
	Route::get('/deposits/create', App\Livewire\Deposit\Create::class)->name('deposits.create');
	Route::get('/deposits/{deposit}', App\Livewire\Deposit\Show::class)->name('deposits.show');
	Route::get('/withdrawals', WithdrawalIndex::class)->name('withdrawals.index');
	Route::get('/withdrawals/{withdrawal}', WithdrawalShow::class)->name('withdrawals.show');
	Route::post('/withdrawals/{withdrawal}/approve', [App\Http\Controllers\WithdrawalController::class, 'approve'])->name('withdrawals.approve');
});
