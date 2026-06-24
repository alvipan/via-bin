<?php

namespace App\Livewire\Onboarding;

use App\Models\Tenant;
use App\Support\TenantContext;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public string $name = '';
    public string $slug = '';

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:tenants,slug'],
        ];
    }

    public function createTenant(): void
    {
        $this->validate();

        $tenant = Tenant::create([
            'name' => $this->name,
            'slug' => $this->slug,
            'status' => 'active',
        ]);

        $user = Auth::user();
        $user->tenants()->syncWithoutDetaching([
            $tenant->id => ['role' => 'owner', 'status' => 'active'],
        ]);

        session()->put('tenant_id', $tenant->id);
        TenantContext::set($tenant);

        redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.onboarding.index')->layout('components.layouts.app');
    }
}
