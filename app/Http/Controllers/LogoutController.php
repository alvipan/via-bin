<?php

namespace App\Http\Controllers;

use App\Services\ViaAccountService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LogoutController
{
    public function __invoke(ViaAccountService $viaAccount): RedirectResponse
    {
        if ($token = session('viaaccount_access_token')) {
            rescue(fn () => $viaAccount->revokeToken($token));
        }

        Auth::logout();

        session()->invalidate();
        session()->regenerateToken();

        return redirect('/');
    }
}