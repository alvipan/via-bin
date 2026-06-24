<?php

namespace App\Livewire\Sales;

use App\Models\Lot;
use App\Models\Sale;
use App\Models\WasteCategory;
use App\Services\SalesService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Create extends Component
{
    public string $buyer_name = '';
    public string $buyer_type = '';
    public float $unit_price = 0.0;
    public array $allocations = [];
    public array $lots = [];

    public function mount(): void
    {
        $this->lots = Lot::query()->where('remaining_quantity', '>', 0)->get()->toArray();
    }

    public function rules(): array
    {
        return [
            'buyer_name' => ['required', 'string', 'max:255'],
            'buyer_type' => ['nullable', 'string', 'max:255'],
            'unit_price' => ['required', 'numeric', 'gt:0'],
            'allocations' => ['required', 'array', 'min:1'],
            'allocations.*.lot_id' => ['required', 'integer', 'exists:lots,id'],
            'allocations.*.quantity' => ['required', 'numeric', 'gt:0'],
        ];
    }

    public function addAllocation(int $lotId): void
    {
        if (! isset($this->allocations[$lotId])) {
            $this->allocations[$lotId] = [
                'lot_id' => $lotId,
                'quantity' => 0,
            ];
        }
    }

    public function submit(SalesService $salesService): void
    {
        $this->validate();

        $allocations = array_values(array_map(function ($item) {
            return [
                'lot_id' => (int) ($item['lot_id'] ?? 0),
                'quantity' => (float) ($item['quantity'] ?? 0),
                'fee_amount' => isset($item['fee_amount']) ? (float) $item['fee_amount'] : 0,
            ];
        }, $this->allocations));

        $sale = $salesService->create([
            'created_by' => Auth::id(),
            'buyer_name' => $this->buyer_name,
            'buyer_type' => $this->buyer_type,
            'unit_price' => $this->unit_price,
            'allocations' => $allocations,
        ]);

        redirect()->route('sales.show', $sale);
    }

    public function render()
    {
        return view('livewire.sales.create', [
            'lots' => Lot::query()->where('remaining_quantity', '>', 0)->get(),
        ])->layout('components.layouts.app');
    }
}
