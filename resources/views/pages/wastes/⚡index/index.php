<?php

use App\Enums\Unit;
use App\Enums\TenantModule;
use App\Models\WasteType;
use App\Models\Concerns\AuthorizesTenant;
use App\Services\WasteTypeService;
use App\Support\TenantContext;
use Illuminate\Validation\Rules\Enum;
use Livewire\Component;

new class extends Component
{
    use AuthorizesTenant;

    public bool $modal = false;

    public ?int $editingId = null;

    public string $name = '';

    public string $unit = 'kg';

    public float $estimatedPrice = 0;

    public bool $isActive = true;

    public function mount()
    {
        $this->authorizeModule(TenantModule::WasteTypes);
    }

    public function create(): void
    {
        $this->reset([
            'editingId',
            'name',
            'estimatedPrice',
        ]);

        $this->unit = 'kg';
        $this->isActive = true;

        $this->modal = true;
    }

    public function edit(int $id): void
    {
        $waste = WasteType::findOrFail($id);

        $this->editingId = $waste->id;
        $this->name = $waste->name;
        $this->unit = $waste->unit->value;
        $this->estimatedPrice = $waste->estimated_price;
        $this->isActive = $waste->is_active;

        $this->modal = true;
    }

    public function save(
        WasteTypeService $service
    ): void {

        $this->validate([
            'name' => ['required', 'max:100'],
            'unit' => ['required', new Enum(Unit::class)],
            'estimatedPrice' => ['required', 'numeric', 'min:0'],
        ]);

        if ($this->editingId) {

            $service->update(
                WasteType::findOrFail($this->editingId),
                $this->name,
                $this->unit,
                $this->estimatedPrice,
            );

        } else {

            $service->create(
                TenantContext::tenant(),
                $this->name,
                $this->unit,
                $this->estimatedPrice,
            );
        }

        $this->modal = false;
    }

    public function toggle(
        int $id,
        WasteTypeService $service
    ): void {

        $waste = WasteType::findOrFail($id);

        if ($waste->is_active) {
            $service->deactivate($waste);
        } else {
            $service->activate($waste);
        }
    }

    public function render()
    {
        return $this->view([
            'wastes' => WasteType::query()
                ->orderBy('name')
                ->get(),
        ]);
    }
};