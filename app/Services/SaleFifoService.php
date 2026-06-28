<?php

namespace App\Services;

use App\Models\Lot;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\SaleItemLot;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class SaleFifoService
{
    /**
     * Allocate all sale items using FIFO lot system.
     */
    public function allocate(Sale $sale): void
    {
        DB::transaction(function () use ($sale) {

            $sale->loadMissing('items');

            foreach ($sale->items as $item) {
                $this->allocateItem($sale, $item);
            }

        });
    }

    /**
     * Allocate single sale item
     */
    protected function allocateItem(Sale $sale, SaleItem $item): void
    {
        $remaining = (float) $item->quantity;

        $lots = Lot::query()
            ->where('tenant_id', $sale->tenant_id)
            ->whereHas('depositItem', function ($query) use ($item) {
                $query->where('waste_type_id', $item->waste_type_id);
            })
            ->where('quantity_remaining', '>', 0)
            ->orderBy('created_at')
            ->lockForUpdate()
            ->get();

        if ($lots->isEmpty()) {
            throw new RuntimeException(
                "No available stock for waste type ID: {$item->waste_type_id}"
            );
        }

        foreach ($lots as $lot) {

            if ($remaining <= 0) {
                break;
            }

            $available = (float) $lot->quantity_remaining;

            if ($available <= 0) {
                continue;
            }

            $take = min($available, $remaining);

            SaleItemLot::create([
                'sale_item_id' => $item->id,
                'lot_id'       => $lot->id,
                'quantity'     => $take,
            ]);

            $lot->reduceQuantity($take);

            $remaining -= $take;
        }

        if ($remaining > 0) {
            throw new RuntimeException(
                "Insufficient stock for waste type ID: {$item->waste_type_id}. Missing: {$remaining}"
            );
        }
    }
}