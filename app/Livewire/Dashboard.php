<?php

namespace App\Livewire;

use App\Models\Deposit;
use App\Models\Lot;
use App\Models\MemberProfile;
use App\Models\Sale;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.dashboard', [
            'memberCount' => MemberProfile::count(),
            'openLotCount' => Lot::whereIn('status', ['available', 'partial'])->count(),
            'depositCount' => Deposit::count(),
            'saleCount' => Sale::count(),
        ])->layout('components.layouts.app');
    }
}
