<?php

namespace App\Http\Middleware;

use App\Models\Tenant;
use App\Models\TenantUser;
use App\Support\TenantContext;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ResolveTenant
{
    public function handle(Request $request, Closure $next): Response
    {
        $tenant = $this->resolveTenant($request);

        $membership = $tenant
            ? $this->resolveMembership($tenant)
            : null;

        TenantContext::set($tenant, $membership);

        try {
            return $next($request);
        } finally {
            TenantContext::clear();
        }
    }

    private function resolveTenant(Request $request): ?Tenant
    {
        if (! Auth::check()) {
            return null;
        }

        $tenantKey = $request->route('tenant')
            ?? $request->header('X-Tenant')
            ?? $request->session()->get('tenant_id');

        if ($tenantKey) {
            $query = Tenant::query()
                ->where('status', 'active');

            is_numeric($tenantKey)
                ? $query->whereKey((int) $tenantKey)
                : $query->where('slug', $tenantKey);

            $tenant = $query->first();

            if ($tenant && $this->resolveMembership($tenant)) {
                $request->session()->put('tenant_id', $tenant->id);

                return $tenant;
            }
        }

        return null;
    }

    private function resolveMembership(Tenant $tenant): ?TenantUser
    {
        if (! Auth::check()) {
            return null;
        }

        return TenantUser::query()
            ->whereBelongsTo($tenant)
            ->where('user_id', Auth::id())
            ->active()
            ->first();
    }
}