<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Support\TenantContext;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TenantController
{
    public function switch(Tenant $tenant): RedirectResponse
    {
        $user = Auth::user();

        abort_unless($user && $user->tenants()->whereKey($tenant->id)->exists(), 403);

        session()->put('tenant_id', $tenant->id);
        TenantContext::set($tenant);

        return redirect()->route('dashboard');
    }
}
