<?php

namespace App\Livewire\Tenant;

use App\Models\Tenant;
use Livewire\Component;

class Edit extends Component
{
    public Tenant $tenant;
    public string $name = '';
    public string $status = '';

    public function mount(Tenant $tenant)
    {
        $this->tenant = $tenant;
        $this->name = $tenant->name;
        $this->status = $tenant->status;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'in:active,inactive'],
        ];
    }

    public function submit(): void
    {
        $this->validate();

        $this->tenant->update([
            'name' => $this->name,
            'status' => $this->status,
        ]);

        redirect()->route('tenants.index');
    }

    public function render()
    {
        return view('livewire.tenant.edit', [
            'tenant' => $this->tenant,
        ])->layout('components.layouts.app');
    }
}
