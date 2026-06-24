<?php

namespace App\Services;

use App\Models\Deposit;
use Illuminate\Support\Facades\DB;
use App\Services\LedgerService;
use App\Models\MemberProfile;

class DepositService
{
    public function __construct(
        private readonly LotService $lotService,
        private readonly LedgerService $ledgerService,
    ) {}

    /**
     * @param  array{
     *     member_profile_id:int,
     *     waste_category_id:int,
     *     created_by:int,
     *     reference_number?:string,
     *     quantity:float,
     *     unit_price:float,
     *     deposited_at?:mixed
     * }  $data
     */
    public function create(array $data): Deposit
    {
        return DB::transaction(function () use ($data): Deposit {
            $quantity = (float) $data['quantity'];
            $unitPrice = (float) $data['unit_price'];

            $memberProfile = MemberProfile::query()->findOrFail($data['member_profile_id']);

            $deposit = Deposit::create([
                'member_profile_id' => $data['member_profile_id'],
                'waste_category_id' => $data['waste_category_id'],
                'created_by' => $data['created_by'],
                'reference_number' => $data['reference_number'] ?? $this->makeReferenceNumber(),
                'quantity' => $quantity,
                'unit_price' => $unitPrice,
                'subtotal' => $quantity * $unitPrice,
                'status' => 'processed',
                'deposited_at' => $data['deposited_at'] ?? now(),
            ]);

            $this->lotService->createFromDeposit($deposit);

            $this->ledgerService->credit(
                $memberProfile,
                Deposit::class,
                $deposit->id,
                $deposit->subtotal,
            );

            return $deposit->load(['lot', 'memberProfile', 'wasteCategory']);
        });
    }

    private function makeReferenceNumber(): string
    {
        return 'DEP-'.now()->format('YmdHis');
    }
}
