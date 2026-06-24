<?php

namespace App\Livewire\Deposit;

use App\Models\Deposit;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.deposit.index', [
            'deposits' => Deposit::query()->latest('deposited_at')->get(),
        ])->layout('components.layouts.app');
    }
}
