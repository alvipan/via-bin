<?php

use App\Models\Tenant;
use App\Support\TenantContext;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

new class extends Component
{
    public string $name = '';
    public string $slug = '';

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255']
        ];
    }

    public function updatedName(string $value): void
    {
        if (blank($this->slug)) {
            $this->slug = Str::slug($value);
        }
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
        return $this->view();
    }
}
