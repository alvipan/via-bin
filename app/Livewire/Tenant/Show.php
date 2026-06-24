<?php

namespace App\Livewire\Tenant;

use App\Models\Tenant;
use Livewire\Component;

class Show extends Component
{
    public Tenant $tenant;

    public function mount(Tenant $tenant)
    {
        $this->tenant = $tenant;
    }

    public function render()
    {
        return view('livewire.tenant.show', [
            'memberCount' => $this->tenant->memberProfiles()->count(),
            'depositCount' => $this->tenant->deposits()->count(),
            'lotCount' => $this->tenant->lots()->count(),
        ])->layout('components.layouts.app');
    }
}
