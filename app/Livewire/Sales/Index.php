<?php

namespace App\Livewire\Sales;

use App\Models\Sale;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.sales.index', [
            'sales' => Sale::query()->latest('sold_at')->get(),
        ])->layout('components.layouts.app');
    }
}
