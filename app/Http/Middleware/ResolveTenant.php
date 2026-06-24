<?php

namespace App\Http\Middleware;

use App\Models\Tenant;
use App\Support\TenantContext;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ResolveTenant
{
    public function handle(Request $request, Closure $next): Response
    {
        TenantContext::set($this->resolveTenant($request));

        try {
            return $next($request);
        } finally {
            TenantContext::clear();
        }
    }

    private function resolveTenant(Request $request): ?Tenant
    {
        $tenantKey = $request->route('tenant')
            ?? $request->header('X-Tenant')
            ?? $request->session()->get('tenant_id');

        if ($tenantKey) {
            $query = Tenant::query()->where('status', 'active');

            is_numeric($tenantKey)
                ? $query->whereKey((int) $tenantKey)
                : $query->where('slug', $tenantKey);

            $tenant = $query->first();

            if ($tenant && $this->userCanAccessTenant($tenant)) {
                $request->session()->put('tenant_id', $tenant->id);

                return $tenant;
            }
        }

        $user = Auth::user();

        if (! $user) {
            return null;
        }

        $tenant = $user->tenants()
            ->wherePivot('status', 'active')
            ->where('tenants.status', 'active')
            ->first();

        if ($tenant) {
            $request->session()->put('tenant_id', $tenant->id);
        }

        return $tenant;
    }

    private function userCanAccessTenant(Tenant $tenant): bool
    {
        $user = Auth::user();

        if (! $user) {
            return true;
        }

        return $user->tenants()
            ->whereKey($tenant->id)
            ->wherePivot('status', 'active')
            ->exists();
    }
}
