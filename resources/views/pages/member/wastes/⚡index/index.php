<?php

use App\Models\WasteType;
use Livewire\Component;

new class extends Component
{
    public function render()
    {
        return $this->view([
            'wasteTypes' => WasteType::query()
                ->where('is_active', true)
                ->orderBy('name')
                ->get(),
        ])->layout('layouts::member.app');
    }
};
