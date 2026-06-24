<?php

namespace App\Livewire\Deposit;

use App\Models\Deposit;
use Livewire\Component;

class Show extends Component
{
    public Deposit $deposit;

    public function mount(Deposit $deposit)
    {
        $this->deposit = $deposit->load('lot', 'memberProfile', 'wasteCategory');
    }

    public function render()
    {
        return view('livewire.deposit.show', [
            'deposit' => $this->deposit,
        ])->layout('components.layouts.app');
    }
}
