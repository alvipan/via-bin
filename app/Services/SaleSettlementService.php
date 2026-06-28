<?php

namespace App\Services;

use App\Enums\MemberLedgerType;
use App\Enums\SaleStatus;
use App\Enums\TenantLedgerType;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class SaleSettlementService
{
    public function __construct(
        protected MemberLedgerService $memberLedgerService,
        protected TenantLedgerService $tenantLedgerService,
    ) {}

    public function settle(Sale $sale): void
    {
        DB::transaction(function () use ($sale) {

            $sale->loadMissing([
                'items.lots.lot',
            ]);

            if (! $sale->isDraft()) {
                throw new RuntimeException('Sale has already been settled.');
            }

            $summary = $this->settleMembers($sale);

            $this->settleTenant(
                sale: $sale,
                operationalFee: $summary['operational_fee'],
            );

            $sale->update([
                'status' => SaleStatus::Posted,

                'gross_amount' => $summary['gross'],
                'operational_amount' => $summary['operational_fee'],
                'net_amount' => $summary['net'],

                'posted_at' => now(),
                'posted_by' => $sale->created_by,
            ]);
        });
    }

    private function settleMembers(Sale $sale): array
    {
        $gross = 0;
        $operationalFee = 0;

        foreach ($sale->items as $item) {

            foreach ($item->lots as $itemLot) {

                $lot = $itemLot->lot;

                $grossAmount = round(
                    (float) $itemLot->quantity * (float) $item->unit_price,
                    2,
                );

                $fee = round(
                    $grossAmount * ((float) $sale->operational_percent / 100),
                    2,
                );

                $memberAmount = $grossAmount - $fee;

                $gross += $grossAmount;
                $operationalFee += $fee;

                $this->memberLedgerService->record(
                    memberId: $lot->member_id,
                    type: MemberLedgerType::Sale,
                    reference: $sale,
                    credit: $memberAmount,
                    description: 'Sale Settlement',
                    createdBy: $sale->created_by,
                );
            }
        }

        return [
            'gross' => round($gross, 2),
            'operational_fee' => round($operationalFee, 2),
            'net' => round($gross - $operationalFee, 2),
        ];
    }

    private function settleTenant(
        Sale $sale,
        float $operationalFee,
    ): void {

        if ($operationalFee <= 0) {
            return;
        }

        $this->tenantLedgerService->record(
            type: TenantLedgerType::OperationalIncome,
            reference: $sale,
            credit: $operationalFee,
            description: 'Operational Fee',
            createdBy: $sale->created_by,
        );
    }
}