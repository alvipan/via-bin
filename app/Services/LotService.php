<?php

namespace App\Services;

use App\Models\Deposit;
use App\Models\Lot;
use Illuminate\Validation\ValidationException;

class LotService
{
    public function createFromDeposit(Deposit $deposit): Lot
    {
        return Lot::create([
            'tenant_id' => $deposit->tenant_id,
            'deposit_id' => $deposit->id,
            'member_profile_id' => $deposit->member_profile_id,
            'waste_category_id' => $deposit->waste_category_id,
            'lot_number' => $this->makeLotNumber($deposit),
            'initial_quantity' => $deposit->quantity,
            'remaining_quantity' => $deposit->quantity,
            'status' => 'available',
        ]);
    }

    public function consume(Lot $lot, float $quantity): Lot
    {
        if ((float) $lot->remaining_quantity < $quantity) {
            throw ValidationException::withMessages([
                'quantity' => 'Quantity exceeds available lot quantity.',
            ]);
        }

        $remaining = (float) $lot->remaining_quantity - $quantity;

        $lot->forceFill([
            'remaining_quantity' => $remaining,
            'status' => $remaining <= 0 ? 'sold' : 'partial',
        ])->save();

        return $lot;
    }

    private function makeLotNumber(Deposit $deposit): string
    {
        return sprintf('LOT-%s-%06d', now()->format('Ymd'), $deposit->id);
    }
}
