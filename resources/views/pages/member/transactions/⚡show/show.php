<?php

use App\Models\MemberLedger;
use App\Models\Sale;
use Livewire\Component;

new class extends Component
{
    public MemberLedger $ledger;

    public function mount(MemberLedger $transaction)
    {
        $this->ledger = $transaction;

        if ($this->ledger->member_id !== auth()->guard('member')->id()) {
            abort(403, 'Akses ditolak.');
        }

        $this->ledger->load('reference');

        if ($this->ledger->reference instanceof Sale) {
            $this->ledger->reference->load('items.wasteType');
        }
    }

    public function render()
    {
        return $this->view()
            ->layout('layouts::member.app', [
                'title' => 'Detail Transaksi',
            ]);
    }
};
