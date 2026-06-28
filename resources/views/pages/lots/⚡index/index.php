<?php

use App\Enums\LotStatus;
use App\Models\Lot;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component
{
    use WithPagination;

    #[Url(as: 'q', keep: true)]
    public string $search = '';

    #[Url(keep: true)]
    public string $status = '';

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedStatus(): void
    {
        $this->resetPage();
    }

    #[Computed]
    public function lots()
    {
        return Lot::query()
            ->with([
                'member',
                'depositItem.deposit',
                'depositItem.wasteType',
            ])
            ->search($this->search)
            ->when(
                filled($this->status),
                fn ($query) => $query->where('status', $this->status)
            )
            ->latest()
            ->paginate(15);
    }

    public function getStatusesProperty(): array
    {
        return LotStatus::cases();
    }
};