<?php

namespace App\Services;

use App\Models\Lot;
use App\Models\Sale;
use App\Models\SaleAllocation;
use Illuminate\Support\Facades\DB;
use App\Services\OperationalTransactionService;
use App\Services\LedgerService;

class SalesService
{
    public function __construct(
        private readonly LotService $lotService,
        private readonly LedgerService $ledgerService,
        private readonly OperationalTransactionService $operationalTransactionService,
    ) {}

    /**
     * @param  array{
     *     created_by:int,
     *     reference_number?:string,
     *     buyer_name:string,
     *     buyer_type?:string|null,
     *     unit_price:float,
     *     sold_at?:mixed,
     *     allocations:array<int,array{lot_id:int,quantity:float,fee_amount?:float}>
     * }  $data
     */
    public function create(array $data): Sale
    {
        return DB::transaction(function () use ($data): Sale {
            $unitPrice = (float) $data['unit_price'];
            $totalQuantity = collect($data['allocations'])->sum(fn (array $allocation): float => (float) $allocation['quantity']);

            $sale = Sale::create([
                'created_by' => $data['created_by'],
                'reference_number' => $data['reference_number'] ?? $this->makeReferenceNumber(),
                'buyer_name' => $data['buyer_name'],
                'buyer_type' => $data['buyer_type'] ?? null,
                'quantity' => $totalQuantity,
                'unit_price' => $unitPrice,
                'gross_amount' => $totalQuantity * $unitPrice,
                'sold_at' => $data['sold_at'] ?? now(),
            ]);

            foreach ($data['allocations'] as $allocationData) {
                $lot = Lot::query()->lockForUpdate()->findOrFail($allocationData['lot_id']);
                $quantity = (float) $allocationData['quantity'];
                $grossAmount = $quantity * $unitPrice;
                $feeAmount = (float) ($allocationData['fee_amount'] ?? 0);
                $netAmount = $grossAmount - $feeAmount;

                $this->lotService->consume($lot, $quantity);

                $allocation = SaleAllocation::create([
                    'tenant_id' => $sale->tenant_id,
                    'sale_id' => $sale->id,
                    'lot_id' => $lot->id,
                    'member_profile_id' => $lot->member_profile_id,
                    'quantity' => $quantity,
                    'gross_amount' => $grossAmount,
                    'fee_amount' => $feeAmount,
                    'net_amount' => $netAmount,
                ]);

                $this->ledgerService->credit(
                    $lot->memberProfile,
                    SaleAllocation::class,
                    $allocation->id,
                    $netAmount
                );
            }

            $this->operationalTransactionService->recordRevenue(
                $sale->tenant_id,
                $sale->created_by,
                $sale->gross_amount,
                sprintf('Sale %s to %s', $sale->reference_number, $sale->buyer_name),
            );

            return $sale->load(['allocations.lot', 'allocations.memberProfile']);
        });
    }

    private function makeReferenceNumber(): string
    {
        return 'SAL-'.now()->format('YmdHis');
    }
}
