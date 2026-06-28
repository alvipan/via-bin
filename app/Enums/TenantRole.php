<?php

namespace App\Enums;

enum TenantRole: string
{
    case Owner = 'owner';
    case Admin = 'admin';
    case Cashier = 'cashier';

    public function label(): string
    {
        return match ($this) {
            self::Owner => 'Owner',
            self::Admin => 'Admin',
            self::Cashier => 'Cashier',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Owner => 'red',
            self::Admin => 'blue',
            self::Cashier => 'zinc',
        };
    }

    public function canAccess(TenantModule $module): bool
    {
        return match ($this) {
            self::Owner => true,

            self::Admin => ! in_array($module, [
                TenantModule::Settings,
            ]),

            self::Cashier => in_array($module, [
                TenantModule::Dashboard,
                TenantModule::Members,
                TenantModule::Deposits,
                TenantModule::Sales,
                TenantModule::Withdrawals,
            ]),
        };
    }
}