<?php

namespace App\Livewire\Withdrawal;

use App\Models\Withdrawal;
use App\Services\WithdrawalService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Approve extends Component
{
    public Withdrawal $withdrawal;

    public function mount(Withdrawal $withdrawal)
    {
        $this->withdrawal = $withdrawal;
    }

    public function approve(WithdrawalService $withdrawalService): void
    {
        if ($this->withdrawal->status !== 'pending') {
            return;
        }

        $withdrawalService->approve($this->withdrawal, Auth::id());

        redirect()->route('withdrawals.show', $this->withdrawal);
    }

    public function render()
    {
        return view('livewire.withdrawal.approve', [
            'withdrawal' => $this->withdrawal,
        ])->layout('components.layouts.app');
    }
}
