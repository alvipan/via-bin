<?php

use App\Enums\SaleStatus;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\WasteType;
use App\Models\Lot;
use App\Services\SaleService;
use Livewire\Component;

new class extends Component
{
    public Sale $sale;

    public bool $postModal = false;
    public bool $itemModal = false;

    public ?int $editingItemId = null;
    public ?int $wasteTypeId = null;

    public string $quantity = '';
    public string $unitPrice = '';
    public string $notes = '';

    /* -------------------------------------------------
     | INIT
     * -------------------------------------------------*/
    public function mount(Sale $sale): void
    {
        $this->sale = $sale->load(['items.wasteType']);
    }

    /* -------------------------------------------------
     | COMPUTED DATA
     * -------------------------------------------------*/
    public function getWasteTypesProperty()
    {
        return WasteType::query()->orderBy('name')->get();
    }

    public function getSubtotalProperty(): float
    {
        return (float) $this->quantity * (float) $this->unitPrice;
    }

    public function getGrossProperty(): float
    {
        return $this->sale->items->sum('subtotal');
    }

    public function getAvailableStockProperty(): float
    {
        if (! $this->wasteTypeId) {
            return 0;
        }

        return Lot::availableStock(
            $this->sale->tenant_id,
            $this->wasteTypeId
        );
    }

    public function getFinancialsProperty()
    {
        $gross = $this->sale->items->sum('subtotal');
        $op = $gross * ($this->sale->operational_percent / 100);

        return [
            'gross' => $gross,
            'operational' => $op,
            'net' => $gross - $op,
        ];
    }

    /* -------------------------------------------------
     | ITEM ACTIONS
     * -------------------------------------------------*/
    public function createItem(): void
    {
        $this->resetItemState();
        $this->itemModal = true;
    }

    public function editItem(SaleItem $item): void
    {
        $this->fillItemState($item);
        $this->itemModal = true;
    }

    public function saveItem(): void
    {
        $this->guardIfPosted();

        SaleItem::updateOrCreate(
            ['id' => $this->editingItemId],
            [
                'sale_id' => $this->sale->id,
                'waste_type_id' => $this->wasteTypeId,
                'quantity' => $this->quantity,
                'unit_price' => $this->unitPrice,
                'subtotal' => $this->subtotal,
                'notes' => $this->notes,
            ]
        );

        $this->refreshSale();
        $this->resetItemState();
        $this->itemModal = false;
    }

    public function deleteItem(SaleItem $item): void
    {
        $this->guardIfPosted();

        $item->delete();

        $this->refreshSale();
    }

    /* -------------------------------------------------
     | REACTIVE HANDLER
     * -------------------------------------------------*/
    public function updatedWasteTypeId(): void
    {
        // nothing needed here anymore
        // stock is computed via getter
    }

    /* -------------------------------------------------
     | POST FLOW
     * -------------------------------------------------*/
    public function confirmPost(): void
    {
        $this->postModal = true;
    }

    public function post(SaleService $saleService): void
    {
        $this->sale->load('items');

        if ($this->sale->status !== SaleStatus::Draft) {
            $this->addError('post', 'Sale is already posted.');
            return;
        }

        if ($this->sale->items->isEmpty()) {
            $this->addError('post', 'Sale must have at least one item.');
            return;
        }

        try {
            $saleService->post($this->sale);

            $this->sale->refresh();

            $this->postModal = false;

            session()->flash('success', 'Sale posted successfully.');

        } catch (\Throwable $e) {

            report($e);

            $this->addError('post', $e->getMessage());
        }
    }

    /* -------------------------------------------------
     | INTERNAL HELPERS
     * -------------------------------------------------*/
    protected function refreshSale(): void
    {
        $this->sale->refresh();
        $this->sale->load(['items.wasteType']);
    }

    protected function resetItemState(): void
    {
        $this->editingItemId = null;
        $this->wasteTypeId = null;
        $this->quantity = '';
        $this->unitPrice = '';
        $this->notes = '';
    }

    protected function fillItemState(SaleItem $item): void
    {
        $this->editingItemId = $item->id;
        $this->wasteTypeId = $item->waste_type_id;
        $this->quantity = (string) $item->quantity;
        $this->unitPrice = (string) $item->unit_price;
        $this->notes = $item->notes ?? '';
    }

    protected function guardIfPosted(): void
    {
        if ($this->sale->status !== SaleStatus::Draft) {
            throw new RuntimeException('Sale is immutable.');
        }
    }

    public function render()
    {
        return $this->view();
    }
};