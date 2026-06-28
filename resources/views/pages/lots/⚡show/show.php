<?php

use App\Models\Lot;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component
{
    public Lot $lot;

    public function mount(Lot $lot): void
    {
        $this->lot = $lot->load([
            'member',
            'depositItem.deposit',
            'depositItem.wasteType',
            'saleItemLots.saleItem.sale',
        ]);
    }

    #[Computed]
    public function quantitySold(): float
    {
        return (float) $this->lot->quantity_received
            - (float) $this->lot->quantity_remaining;
    }
};