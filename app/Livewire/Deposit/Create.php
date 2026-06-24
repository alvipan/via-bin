<?php

namespace App\Livewire\Deposit;

use App\Models\MemberProfile;
use App\Models\WasteCategory;
use App\Services\DepositService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Create extends Component
{
    public ?int $member_profile_id = null;
    public ?int $waste_category_id = null;
    public float $quantity = 0.0;
    public float $unit_price = 0.0;
    public string $reference_number = '';

    public function rules(): array
    {
        return [
            'member_profile_id' => ['required', 'integer', 'exists:member_profiles,id'],
            'waste_category_id' => ['required', 'integer', 'exists:waste_categories,id'],
            'quantity' => ['required', 'numeric', 'gt:0'],
            'unit_price' => ['required', 'numeric', 'gte:0'],
        ];
    }

    public function submit(DepositService $depositService): void
    {
        $this->validate();

        $deposit = $depositService->create([
            'member_profile_id' => $this->member_profile_id,
            'waste_category_id' => $this->waste_category_id,
            'created_by' => Auth::id(),
            'reference_number' => $this->reference_number ?: null,
            'quantity' => $this->quantity,
            'unit_price' => $this->unit_price,
        ]);

        redirect()->route('deposits.show', $deposit);
    }

    public function render()
    {
        return view('livewire.deposit.create', [
            'members' => MemberProfile::query()->get(),
            'categories' => WasteCategory::query()->active()->get(),
        ])->layout('components.layouts.app');
    }
}
