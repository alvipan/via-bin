<?php

namespace App\Livewire\Tenant;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $user = Auth::user();

        return view('livewire.tenant.index', [
            'tenants' => $user->tenants()->withPivot('role', 'status')->get(),
            'activeTenantId' => session('tenant_id'),
        ])->layout('components.layouts.app');
    }
}
