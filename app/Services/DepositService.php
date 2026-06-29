<?php

namespace App\Services;

use App\Enums\DepositStatus;
use App\Enums\SequenceType;
use App\Enums\LotStatus;
use App\Models\Deposit;
use App\Models\DepositItem;
use App\Models\Lot;
use App\Models\Member;
use App\Models\Tenant;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class DepositService
{
    public function create(
        Tenant $tenant,
        Member $member,
        int $createdBy,
        ?string $notes = null,
    ): Deposit {
        return DB::transaction(function () use (
            $tenant,
            $member,
            $createdBy,
            $notes
        ) {
            return Deposit::create([
                'member_id' => $member->id,
                'status' => DepositStatus::Draft,
                'notes' => $notes,
                'created_by' => $createdBy,
            ]);
        });
    }

    public function post(
        Deposit $deposit,
        int $postedBy,
    ): void {

        if (! $deposit->isDraft()) {
            throw ValidationException::withMessages([
                'deposit' => 'Deposit has already been posted.',
            ]);
        }

        DB::transaction(function () use (
            $deposit,
            $postedBy
        ) {

            $deposit->load([
                'items.wasteType',
            ]);

            if ($deposit->items->isEmpty()) {
                throw ValidationException::withMessages([
                    'deposit' => 'Deposit has no items.',
                ]);
            }

            foreach ($deposit->items as $item) {
                $this->createLot($deposit, $item);
            }

            $deposit->update([
                'status' => DepositStatus::Posted,
                'posted_at' => now(),
                'posted_by' => $postedBy,
            ]);
        });
    }

    private function createLot(
        Deposit $deposit,
        DepositItem $item,
    ): void {
        Lot::create([
            'tenant_id' => $deposit->tenant_id,
            'member_id' => $deposit->member_id,
            'deposit_item_id' => $item->id,
            'quantity_received' => $item->quantity,
            'quantity_remaining' => $item->quantity,
            'status' => LotStatus::Open,
        ]);
    }

    public function cancel(Deposit $deposit): void
    {
        if (! $deposit->isDraft()) {
            throw ValidationException::withMessages([
                'deposit' => 'Deposit has already been posted.',
            ]);
        }

        $deposit->update([
            'status' => DepositStatus::Cancelled,
        ]);
    }
}