<?php

namespace App\Services;

use App\Models\Sale;

class SaleCalculationService
{
    /**
     * Calculate sale amounts.
     */
    public function calculate(Sale $sale): void
    {
        $sale->loadMissing([
            'items',
            'items.lots.lot',
        ]);

        $gross = 0;
        $operational = 0;

        foreach ($sale->items as $item) {

            $gross += (float) $item->subtotal;

            foreach ($item->lots as $usage) {
                $operational +=
                    (float) $usage->quantity *
                    (float) $usage->lot->cost_per_unit;
            }
        }

        $sale->update([
            'gross_amount' => $gross,
            'operational_amount' => $operational,
            'net_amount' => $gross - $operational,
        ]);
    }
}