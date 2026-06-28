<?php

use App\Models\Deposit;
use App\Models\Member;
use App\Services\DepositService;
use App\Support\TenantContext;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component
{
    use WithPagination;

    public string $search = '';

    public bool $createModal = false;

    public ?int $memberId = null;

    public string $notes = '';

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function create(): void
    {
        $this->resetForm();

        $this->createModal = true;
    }

    public function store(
        DepositService $service
    ) {
        $this->validate([
            'memberId' => [
                'required',
                'exists:members,id',
            ],
        ]);

        $member = Member::query()
            ->findOrFail($this->memberId);

        $deposit = $service->create(
            tenant: TenantContext::tenant(),
            member: $member,
            createdBy: auth()->id(),
            notes: blank($this->notes)
                ? null
                : $this->notes,
        );

        return redirect()->route(
            'deposits.show',
            $deposit
        );
    }

    protected function resetForm(): void
    {
        $this->reset([
            'memberId',
            'notes',
        ]);
    }

    protected function deposits()
    {
        return Deposit::query()
            ->with('member')
            ->when(
                filled($this->search),
                fn ($query) => $query->where(
                    'deposit_no',
                    'like',
                    "%{$this->search}%"
                )
            )
            ->latest()
            ->paginate();
    }

    protected function members()
    {
        return Member::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get();
    }

    public function render()
    {
        return $this->view([
            'deposits' => $this->deposits(),
            'members' => $this->members(),
        ]);
    }
};