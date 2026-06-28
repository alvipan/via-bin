<?php

namespace App\Models;

use App\Enums\TenantModule;
use App\Enums\TenantRole;
use App\Enums\TenantUserStatus;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'tenant_id',
    'user_id',
    'role',
    'status',
])]

class TenantUser extends Model
{   
    protected function casts(): array
    {
        return [
            'role' => TenantRole::class,
            'status' => TenantUserStatus::class,
        ];
    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function isOwner(): bool
    {
        return $this->role === TenantRole::Owner;
    }

    public function isAdmin(): bool
    {
        return $this->role === TenantRole::Admin;
    }

    public function isCashier(): bool
    {
        return $this->role === TenantRole::Cashier;
    }

    public function isActive(): bool
    {
        return $this->status === TenantUserStatus::Active;
    }

    public function canAccess(TenantModule $module): bool
    {
        return $this->isActive()
            && $this->role->canAccess($module);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', TenantUserStatus::Active);
    }

    public function scopeRole(
        Builder $query,
        TenantRole $role,
    ): Builder {
        return $query->where('role', $role);
    }
}