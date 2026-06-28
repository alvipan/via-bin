<?php

namespace App\Http\Middleware;

use App\Models\TenantUser;
use App\Support\TenantContext;
use App\Services\TenantSwitcherService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureTenant
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! Auth::check()) {
            return redirect()->route('auth.redirect');
        }

        // Sudah ada tenant aktif
        if (TenantContext::hasTenant()) {
            return $next($request);
        }

        $memberships = TenantUser::query()
            ->active()
            ->where('user_id', Auth::id())
            ->whereHas('tenant', fn ($q) => $q->where('status', 'active'))
            ->with('tenant')
            ->get();

        $count = $memberships->count();

        if ($count === 0) {
            return redirect()->route('onboarding');
        }
        
        if ($count === 1) {
            app(TenantSwitcherService::class)
                ->switch(Auth::user(), $memberships->first()->tenant);
        
            return redirect()->route('dashboard');
        }
        
        return redirect()->route('tenants.index');
    }
}
