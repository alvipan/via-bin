<?php

use App\Models\Tenant;
use App\Models\TenantSetting;
use App\Support\TenantContext;
use Livewire\Attributes\Validate;
use Livewire\Component;

new class extends Component
{
    public Tenant $tenant;
    public TenantSetting $setting;

    #[Validate('required|string|max:100')]
    public string $name = '';

    #[Validate('required|numeric|min:0|max:100')]
    public float $operationalFeePercent = 0;

    public function mount(): void
    {
        $this->tenant = TenantContext::current();
        $this->setting = $this->tenant->setting;

        $this->name = $this->tenant->name;
        $this->operationalFeePercent = (float) $this->setting->operational_fee_percent;
    }

    public function save(): void
    {
        $this->validate();

        $this->tenant->update([
            'name' => $this->name,
        ]);

        $this->setting->update([
            'operational_fee_percent' => $this->operationalFeePercent,
        ]);

        $this->dispatch('saved');
    }
};