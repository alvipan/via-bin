<?php

namespace App\Livewire\Deposits;

use App\Models\Deposit;
use App\Models\DepositItem;
use App\Models\WasteType;
use Livewire\Component;
use App\Services\DepositService;

new class extends Component
{
    public Deposit $deposit;

    public bool $itemModal = false;
    public bool $postModal = false;

    public ?int $editingItemId = null;

    public bool $deleteItemModal = false;
    public ?DepositItem $deletingItem = null;

    public ?int $wasteTypeId = null;

    public ?float $quantity = null;

    public function mount(Deposit $deposit): void
    {
        $this->deposit = $deposit->load([
            'member',
            'items.wasteType',
        ]);
    }

    public function addItem(): void
    {
        abort_unless($this->deposit->isDraft(), 403);

        $this->reset([
            'editingItemId',
            'wasteTypeId',
            'quantity',
        ]);

        $this->itemModal = true;
    }

    public function editItem(int $itemId): void
    {
        abort_unless($this->deposit->isDraft(), 403);

        $item = $this->deposit
            ->items()
            ->findOrFail($itemId);

        $this->editingItemId = $item->id;
        $this->wasteTypeId = $item->waste_type_id;
        $this->quantity = (float) $item->quantity;

        $this->itemModal = true;
    }

    public function saveItem(): void
    {
        abort_unless($this->deposit->isDraft(), 403);

        $this->validate([
            'wasteTypeId' => ['required', 'exists:waste_types,id'],
            'quantity' => ['required', 'numeric', 'gt:0'],
        ]);

        if ($this->editingItemId) {
            $item = $this->deposit
                ->items()
                ->findOrFail($this->editingItemId);

            $item->update([
                'waste_type_id' => $this->wasteTypeId,
                'quantity' => $this->quantity,
            ]);
        } else {
            $this->deposit
                ->items()
                ->create([
                    'waste_type_id' => $this->wasteTypeId,
                    'quantity' => $this->quantity,
                ]);
        }

        $this->refreshDeposit();

        $this->itemModal = false;
    }

    public function confirmDeleteItem(int $id): void
    {
        $this->deletingItem = $this->deposit
            ->items
            ->firstWhere('id', $id);

        $this->deleteItemModal = true;
    }

    public function deleteItem(): void
    {
        DepositItem::findOrFail($this->deletingItemId)->delete();

        $this->deleteItemModal = false;

        $this->deletingItemId = null;

        $this->refreshDeposit();
    }

    public function confirmPost(): void
    {
        abort_unless($this->deposit->isDraft(), 403);

        if ($this->deposit->items()->count() === 0) {
            $this->addError(
                'deposit',
                'Deposit must contain at least one item.'
            );

            return;
        }

        $this->postModal = true;
    }

    public function post(
        DepositService $service
    ): void {
        $service->post(
            $this->deposit,
            auth()->user()->id
        );

        $this->postModal = false;

        $this->refreshDeposit();
    }

    protected function refreshDeposit(): void
    {
        $this->deposit->refresh();

        $this->deposit->load([
            'member',
            'items.wasteType',
        ]);
    }

    public function getEstimatedValueProperty(): float
    {
        return $this->deposit->items->sum(
            fn ($item) =>
                $item->quantity *
                $item->wasteType->estimated_price
        );
    }

    public function getSelectedWasteTypeProperty(): ?WasteType
    {
        return $this->wasteTypeId
            ? WasteType::find($this->wasteTypeId)
            : null;
    }

    public function render()
    {
        return $this->view(
            [
                'wasteTypes' => WasteType::query()
                    ->where('is_active', true)
                    ->orderBy('name')
                    ->get(),
            ]
        );
    }
};