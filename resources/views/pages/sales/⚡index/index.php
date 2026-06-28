<?php

use App\Models\Sale;
use App\Enums\SaleStatus;
use App\Enums\SequenceType;
use App\Services\SequenceService;
use App\Support\TenantContext;
use Livewire\Attributes\Layout;
use Livewire\Component;

new class extends Component
{
    public function create()
    {
        $tenant = TenantContext::tenant();

        $sale = Sale::create([
            'tenant_id' => $tenant->id,
            'sale_no' => SequenceService::nextCode(
                tenantId: $tenant->id,
                type: SequenceType::SALE->value,
                prefix: 'SAL',
            ),
            'sale_date' => now(),
            'status' => SaleStatus::Draft,
            'operational_percent' => $tenant->setting->operational_fee_percent,
            'created_by' => auth()->id(),
        ]);

        return $this->redirectRoute('sales.show', $sale);
    }

    public function render()
    {
        return $this->view([
            'sales' => Sale::query()
                ->latest()
                ->paginate(),
        ]);
    }
};