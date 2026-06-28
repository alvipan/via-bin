<?php

namespace App\Services;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Session\Store;

class TenantSwitcherService
{
    public function __construct(
        protected Store $session,
    ) {}

    public function switch(User $user, Tenant $tenant): void
    {
        $membership = $user->tenantUsers()
            ->active()
            ->whereBelongsTo($tenant)
            ->exists();

        throw_unless(
            $membership,
            AuthorizationException::class,
            'You are not a member of this tenant.'
        );

        $this->session->put('tenant_id', $tenant->id);
    }

    public function clear(): void
    {
        $this->session->forget('tenant_id');
    }
}