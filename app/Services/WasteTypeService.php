<?php

namespace App\Services;

use App\Models\Tenant;
use App\Models\WasteType;

class WasteTypeService
{
    public function create(
        Tenant $tenant,
        string $name,
        string $unit,
        float $estimatedPrice = 0,
    ): WasteType {
        return WasteType::create([
            'tenant_id' => $tenant->id,
            'name' => $name,
            'unit' => $unit,
            'estimated_price' => $estimatedPrice,
            'is_active' => true,
        ]);
    }

    public function update(
        WasteType $wasteType,
        string $name,
        string $unit,
        float $estimatedPrice,
    ): void {
        $wasteType->update([
            'name' => $name,
            'unit' => $unit,
            'estimated_price' => $estimatedPrice,
        ]);
    }

    public function deactivate(
        WasteType $wasteType
    ): void {
        $wasteType->update([
            'is_active' => false,
        ]);
    }

    public function activate(
        WasteType $wasteType
    ): void {
        $wasteType->update([
            'is_active' => true,
        ]);
    }
}