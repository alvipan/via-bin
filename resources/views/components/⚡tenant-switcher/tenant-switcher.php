<?php

use App\Models\TenantUser;
use App\Services\TenantSwitcherService;
use Livewire\Component;

new class extends Component
{
    public function switch(
        TenantUser $membership,
        TenantSwitcherService $switcher,
    ) {
        abort_unless(
            $membership->user_id === auth()->id(),
            403
        );

        if ($membership->tenant_id === tenant_id()) {
            return;
        }

        $switcher->switch(
            auth()->user(),
            $membership->tenant,
        );

        return redirect()->route('dashboard');
    }

    public function render()
    {
        return $this->view([
            'memberships' => auth()->user()
                ->activeMemberships()
                ->with('tenant')
                ->get(),
        ]);
    }
};