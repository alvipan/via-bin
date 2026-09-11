<?php

use App\Models\Deposit;
use Livewire\Component;

new class extends Component
{
    public Deposit $deposit;

    public function mount(Deposit $deposit): void
    {
        $memberId = auth()->guard('member')->id();

        // Validasi kepemilikan data setoran
        if ($deposit->member_id !== $memberId) {
            abort(403, 'Anda tidak memiliki akses ke setoran ini.');
        }

        // Load relasi DepositItem beserta WasteType dan Lot-nya
        $this->deposit = $deposit->load([
            'items.wasteType',
            'items.lot',
        ]);
    }

    public function render()
    {
        return $this->view()->layout('layouts::member.app');
    }
};
