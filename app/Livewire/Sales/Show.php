<?php

namespace App\Livewire\Sales;

use App\Models\Sale;
use Livewire\Component;

class Show extends Component
{
    public Sale $sale;

    public function mount(Sale $sale)
    {
        $this->sale = $sale;
    }

    public function render()
    {
        return view('livewire.sales.show', [
            'sale' => $this->sale->load('allocations.lot', 'allocations.memberProfile'),
        ])->layout('components.layouts.app');
    }
}
