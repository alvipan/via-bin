<?php

use App\Enums\TenantLedgerType;
use App\Models\TenantLedger;
use App\Services\TenantLedgerService;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;

    public string $search = '';

    public string $type = '';

    public ?string $startDate = null;

    public ?string $endDate = null;

    public bool $expenseModal = false;

    public float $amount = 0;

    public string $description = '';

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedType(): void
    {
        $this->resetPage();
    }

    public function updatedStartDate(): void
    {
        $this->resetPage();
    }

    public function updatedEndDate(): void
    {
        $this->resetPage();
    }

    #[Computed]
    public function balance(): float
    {
        return TenantLedger::query()
            ->latest('id')
            ->value('balance') ?? 0;
    }

    #[Computed]
    public function totalCredit(): float
    {
        return (float) TenantLedger::query()->sum('credit');
    }

    #[Computed]
    public function totalDebit(): float
    {
        return (float) TenantLedger::query()->sum('debit');
    }

    #[Computed]
    public function totalTransaction(): int
    {
        return TenantLedger::query()->count();
    }

    #[Computed]
    public function ledgers()
    {
        return TenantLedger::query()
            ->with('reference', 'creator')
            ->when($this->search, function ($query) {
                $query->where('description', 'like', "%{$this->search}%");
            })
            ->when($this->type !== '', function ($query) {
                $query->where('type', $this->type);
            })
            ->when($this->startDate, function ($query) {
                $query->whereDate('created_at', '>=', $this->startDate);
            })
            ->when($this->endDate, function ($query) {
                $query->whereDate('created_at', '<=', $this->endDate);
            })
            ->latest('id')
            ->paginate(15);
    }

    public function expense(
        TenantLedgerService $service,
    ): void {

        $this->validate([
            'amount' => ['required', 'numeric', 'min:1'],
            'description' => ['required', 'string', 'max:255'],
        ]);

        $service->record(
            type: TenantLedgerType::OperationalExpense,
            reference: tenant(),
            debit: $this->amount,
            description: $this->description,
        );

        $this->reset(
            'expenseModal',
            'amount',
            'description',
        );

        $this->dispatch('notify', [
            'type' => 'success',
            'message' => 'Pengeluaran berhasil dicatat.',
        ]);
    }

    public function render()
    {
        return $this->view([
            'types' => TenantLedgerType::cases(),
        ]);
    }
};