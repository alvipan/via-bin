<?php

use App\Models\Member;
use App\Enums\TenantModule;
use App\Support\TenantContext;
use Illuminate\Support\Facades\Auth;

if (! function_exists('current_tenant')) {
    function current_tenant()
    {
        return TenantContext::current();
    }
}

if (! function_exists('tenant')) {
    function tenant()
    {
        return TenantContext::tenant();
    }
}

if (! function_exists('tenant_id')) {
    function tenant_id(): ?int
    {
        return TenantContext::id();
    }
}

if (! function_exists('membership')) {
    function membership()
    {
        return TenantContext::membership();
    }
}

if (! function_exists('tenant_can')) {
    function tenant_can(TenantModule $module): bool
    {
        return TenantContext::can($module);
    }
}

if (! function_exists('member')) {
    function member(): ?Member
    {
        /** @var Member|null */
        return Auth::guard('member')->user();
    }
}