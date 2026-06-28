<?php

namespace App\Support;

use App\Enums\TenantModule;
use App\Models\Tenant;
use App\Models\TenantUser;
use App\Models\User;

class TenantContext
{
    private static ?Tenant $tenant = null;

    private static ?TenantUser $membership = null;

    public static function set(
        ?Tenant $tenant,
        ?TenantUser $membership = null,
    ): void {
        self::$tenant = $tenant;
        self::$membership = $membership;
    }

    public static function tenant(): ?Tenant
    {
        return self::$tenant;
    }

    public static function membership(): ?TenantUser
    {
        return self::$membership;
    }

    public static function user(): ?User
    {
        return self::$membership?->user;
    }

    public static function id(): ?int
    {
        return self::$tenant?->id;
    }

    public static function hasTenant(): bool
    {
        return self::$tenant !== null;
    }

    public static function hasMembership(): bool
    {
        return self::$membership !== null;
    }

    public static function clear(): void
    {
        self::$tenant = null;
        self::$membership = null;
    }

    public static function current(): Tenant
    {
        abort_unless(self::$tenant, 404);

        return self::$tenant;
    }

    public static function can(TenantModule $module): bool
    {
        return self::$membership?->canAccess($module) ?? false;
    }
}