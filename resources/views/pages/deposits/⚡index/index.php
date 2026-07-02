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

    public string $memberCode = '';

    public ?Member $member = null;

    public string $notes = '';

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedMemberCode(): void
    {
        $this->member = Member::query()
            ->where('member_code', trim($this->memberCode))
            ->where('is_active', true)
            ->first();
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
            'memberCode' => ['required'],
        ]);

        $member = Member::query()
            ->where('member_code', trim($this->memberCode))
            ->where('is_active', true)
            ->first();

        if (! $member) {
            $this->addError(
                'memberCode',
                'Kode anggota tidak ditemukan.'
            );

            return;
        }

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
            'memberCode',
            'member',
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

    public function render()
    {
        return $this->view([
            'deposits' => $this->deposits(),
        ]);
    }
};