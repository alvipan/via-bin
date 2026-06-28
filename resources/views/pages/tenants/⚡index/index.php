<?php

use App\Models\TenantUser;
use App\Services\TenantSwitcherService;
use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

new class extends Component
{
    public function select(TenantUser $membership, TenantSwitcherService $switcher)
    {
        abort_unless(
            $membership->user_id === Auth::id(),
            403
        );

        abort_unless(
            $membership->isActive(),
            403
        );

        $switcher->switch(
            Auth::user(),
            $membership->tenant,
        );

        return redirect()->route('dashboard');
    }

    public function render()
    {
        $memberships = Auth::user()
            ->activeMemberships()
            ->with('tenant')
            ->orderBy('role')
            ->get();

        return $this->view([
            'memberships' => $memberships,
        ]);
    }
};