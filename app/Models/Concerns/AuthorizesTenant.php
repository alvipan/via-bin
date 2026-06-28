<?php

namespace App\Models\Concerns;

use App\Enums\TenantModule;
use App\Support\TenantContext;

trait AuthorizesTenant
{
    protected function authorizeModule(TenantModule $module): void
    {
        $membership = TenantContext::membership();

        abort_if(
            ! $membership || ! $membership->canAccess($module),
            403
        );
    }
}