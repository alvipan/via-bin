<?php

use App\Models\WasteType;
use Livewire\Attributes\Layout;
use Livewire\Component;

new class extends Component
{
    public WasteType $waste;

    public function mount(WasteType $waste): void
    {
        $this->waste = $waste->load([
            'depositItems.deposit.member',
        ]);
    }

    public function render()
    {
        $stats = [
            'usage_count' => $this->waste->depositItems()->count(),
            'total_quantity' => $this->waste->depositItems()->sum('quantity'),
            'total_amount' => $this->waste->depositItems()->sum('quantity')
                * $this->waste->estimated_price,
        ];

        $recentDeposits = $this->waste->depositItems()
            ->with(['deposit.member'])
            ->latest()
            ->limit(10)
            ->get();

        return $this->view([
            'stats' => $stats,
            'recentDeposits' => $recentDeposits,
        ]);
    }
};