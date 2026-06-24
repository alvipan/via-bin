<?php

namespace App\Livewire\Withdrawal;

use App\Models\Withdrawal;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.withdrawal.index', [
            'withdrawals' => Withdrawal::query()->latest()->get(),
        ])->layout('components.layouts.app');
    }
}
