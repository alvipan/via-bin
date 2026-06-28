<?php

use App\Support\TenantContext;
use App\Models\TenantSetting;
use Livewire\Attributes\Validate;
use Livewire\Component;

new class extends Component
{
    public TenantSetting $setting;

    #[Validate('required|numeric|min:0|max:100')]
    public float $operationalFeePercent = 0;

    public function mount(): void
    {
        $tenant = TenantContext::current();

        $this->setting = $tenant->setting;

        $this->operationalFeePercent = (float) $this->setting->operational_fee_percent;
    }

    public function save(): void
    {
        $this->validate();

        $this->setting->update([
            'operational_fee_percent' => $this->operationalFeePercent,
        ]);

        $this->dispatch('saved');
    }
};