<?php

namespace App\Livewire\Withdrawal;

use App\Models\Withdrawal;
use Livewire\Component;

class Show extends Component
{
    public Withdrawal $withdrawal;

    public function mount(Withdrawal $withdrawal)
    {
        $this->withdrawal = $withdrawal;
    }

    public function render()
    {
        return view('livewire.withdrawal.show', [
            'withdrawal' => $this->withdrawal->load('memberProfile', 'approver'),
        ])->layout('components.layouts.app');
    }
}
