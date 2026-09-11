<?php

use App\Services\MemberDashboardService;
use Livewire\Component;

new class extends Component
{
    public array $summary;

    public function mount(MemberDashboardService $service): void
    {
        $this->summary = $service->summary(
            member()
        );
    }

    public function render()
    {
        return $this->view()->layout('layouts::member.app');
    }
};
