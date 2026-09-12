<?php

use App\Models\MemberLedger;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component
{
    use WithPagination;

    #[Url(history: true)]
    public string $search = '';

    #[Url(history: true)]
    public string $type = '';

    public function render()
    {
        $memberId = auth()->guard('member')->id();

        $ledgers = MemberLedger::query()
            ->where('member_id', $memberId)
            ->when($this->search, function ($query) {
                $query->where('description', 'like', "%{$this->search}%");
            })
            ->when($this->type, fn($query) => $query->where('type', $this->type))
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->latest()
            ->paginate(10);

        return $this->view([
            'ledgers' => $ledgers,
        ])->layout('layouts::member.app');
    }
};
