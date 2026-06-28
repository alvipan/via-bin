<?php

namespace App\Services;

use App\Enums\SaleStatus;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class SaleService
{
    public function __construct(
        protected SaleFifoService $fifoService,
        protected SaleCalculationService $calculationService,
        protected SaleSettlementService $settlementService,
    ) {}

    /**
     * Post sale transaction.
     */
    public function post(Sale $sale): void
    {
        DB::transaction(function () use ($sale) {

            /**
             * =========================================
             * 1. LOCK SALE
             * =========================================
             */
            $sale = Sale::query()
                ->lockForUpdate()
                ->findOrFail($sale->id);

            /**
             * =========================================
             * 2. STATE GUARD
             * =========================================
             */
            if ($sale->status !== SaleStatus::Draft) {
                throw new RuntimeException(
                    'Sale already posted or not editable.'
                );
            }

            /**
             * =========================================
             * 3. LOAD RELATIONS
             * =========================================
             */
            $sale->loadMissing([
                'items',
                'items.wasteType',
            ]);

            if ($sale->items->isEmpty()) {
                throw new RuntimeException(
                    'Cannot post empty sale.'
                );
            }

            /**
             * =========================================
             * 4. FIFO ALLOCATION
             * =========================================
             */
            $this->fifoService->allocate($sale);

            /**
             * =========================================
             * 5. RELOAD RELATIONS
             * =========================================
             */
            $sale->refresh()->load([
                'items',
                'items.lots.lot',
            ]);

            /**
             * =========================================
             * 6. CALCULATE AMOUNTS
             * =========================================
             */
            $this->calculationService->calculate($sale);

            /**
             * =========================================
             * 7. SETTLEMENT
             * =========================================
             */
            $this->settlementService->settle($sale);

            /**
             * =========================================
             * 8. POST
             * =========================================
             */
            $sale->update([
                'status' => SaleStatus::Posted,
                'posted_at' => now(),
                'posted_by' => $sale->created_by,
            ]);
        });
    }
}