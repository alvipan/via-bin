<?php

use App\Enums\DepositStatus;
use App\Models\Deposit;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component
{
    use WithPagination;

    public string $search = '';
    public string $statusFilter = '';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingStatusFilter(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $memberId = auth()->guard('member')->id();

        $deposits = Deposit::query()
            ->where('member_id', $memberId)
            ->with(['items'])
            ->when($this->search, function ($query) {
                $query->where('deposit_no', 'like', '%' . $this->search . '%');
            })
            ->when($this->statusFilter, function ($query) {
                $query->where('status', $this->statusFilter);
            })
            ->latest()
            ->paginate(10);

        return $this->view([
            'deposits' => $deposits,
            'statuses' => DepositStatus::cases(),
        ])->layout('layouts::member.app');;
    }
};
