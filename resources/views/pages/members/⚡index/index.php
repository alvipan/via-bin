<?php

use App\Enums\TenantModule;
use App\Enums\LotStatus;
use App\Models\Member;
use App\Models\MemberLedger;
use App\Models\Concerns\AuthorizesTenant;
use Flux\Flux;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

new class extends Component
{
    use AuthorizesTenant, WithPagination;

    public string $search = '';

    public ?int $memberId = null;

    public string $name = '';
    public string $phone = '';
    public string $address = '';
    public bool $is_active = true;

    public function mount()
    {
        $this->authorizeModule(TenantModule::Members);
    }

    public function create(): void
    {
        $this->resetForm();

        Flux::modal('member-form')->show();
    }

    #[On('member-edit')]
    public function edit($id): void
    {
        $member = Member::findOrFail($id);

        $this->memberId = $member->id;
        $this->name = $member->name;
        $this->phone = $member->phone ?? '';
        $this->address = $member->address ?? '';
        $this->is_active = $member->is_active;

        Flux::modal('member-form')->show();
    }

    public function save(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'max:255'],
            'phone' => ['nullable', 'max:30'],
            'address' => ['nullable'],
            'is_active' => ['boolean'],
        ]);

        Member::updateOrCreate(
            ['id' => $this->memberId],
            $validated
        );

        Flux::modal('member-form')->close();

        Flux::toast(
            text: 'Member saved successfully.'
        );

        $this->resetForm();
        $this->dispatch('member-reload');
    }

    #[On('member-delete')]
    public function confirmDelete($id): void
    {
        $this->memberId = $id;

        Flux::modal('delete-member')->show();
    }

    public function delete(): void
    {
        Member::findOrFail($this->memberId)->delete();

        Flux::modal('delete-member')->close();

        Flux::toast(
            text: 'Member deleted successfully.'
        );

        $this->resetForm();
        $this->dispatch('member-reload');
    }

    protected function resetForm(): void
    {
        $this->reset([
            'memberId',
            'name',
            'phone',
            'address',
        ]);

        $this->is_active = true;
    }

    public function render()
    {
        $members = Member::query()
            ->withCount([
                'lots' => fn ($query) => $query->where(
                    'status',
                    LotStatus::Open
                ),
            ])
            ->addSelect([
                'balance' => MemberLedger::query()
                    ->select('balance')
                    ->whereColumn('member_id', 'members.id')
                    ->latest('id')
                    ->limit(1),
            ])
            ->when(
                $this->search,
                fn ($query) => $query->where(function ($q) {
                    $q->where('member_code', 'like', "%{$this->search}%")
                        ->orWhere('name', 'like', "%{$this->search}%")
                        ->orWhere('phone', 'like', "%{$this->search}%");
                })
            )
            ->latest()
            ->paginate();

        return $this->view([
            'members' => $members,
        ]);
    }
};