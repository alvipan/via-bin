<?php

use App\Models\Member;
use App\Models\Withdrawal;
use App\Services\WithdrawalService;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component
{
    use WithPagination;

    public bool $showModal = false;

    public string $memberCode = '';

    public ?Member $member = null;

    public ?float $balance = null;

    public string $amount = '';

    public string $notes = '';

    public function mount(): void
    {
        $this->date = now()->toDateString();
    }

    public function create(): void
    {
        $this->resetForm();

        $this->date = now()->toDateString();

        $this->showModal = true;
    }

    public function checkMember(): void
    {
        $this->resetErrorBag('memberCode');

        $this->member = Member::query()
            ->where('member_code', $this->memberCode)
            ->first();

        if (! $this->member) {
            $this->balance = null;

            $this->addError(
                'memberCode',
                'Member tidak ditemukan.'
            );

            return;
        }

        $this->balance = $this->member->balance();
    }

    public function updatedMemberCode(): void
    {
        $this->member = null;
        $this->balance = null;
    }

    public function store(
        WithdrawalService $service
    ): void {
        $this->validate([
            'memberCode' => ['required'],
            'amount' => ['required', 'numeric', 'gt:0'],
        ]);

        if (! $this->member) {
            $this->addError(
                'memberCode',
                'Silakan cek member terlebih dahulu.'
            );

            return;
        }

        $service->create([
            'member_id' => $this->member->id,
            'amount' => $this->amount,
            'notes' => $this->notes,
        ]);

        $this->showModal = false;

        $this->resetForm();

        session()->flash(
            'success',
            'Withdrawal berhasil dibuat.'
        );
    }

    private function resetForm(): void
    {
        $this->reset([
            'memberCode',
            'member',
            'balance',
            'amount',
            'notes',
        ]);

        $this->resetValidation();
    }

    public function render()
    {
        return $this->view([
            'withdrawals' => Withdrawal::query()
                ->with('member')
                ->latest()
                ->paginate(),
        ]);
    }
};