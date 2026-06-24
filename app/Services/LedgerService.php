<?php

namespace App\Services;

use App\Models\MemberLedger;
use App\Models\MemberProfile;

class LedgerService
{
    public function credit(MemberProfile $memberProfile, string $referenceType, int $referenceId, float $amount): MemberLedger
    {
        return $this->record($memberProfile, 'credit', $referenceType, $referenceId, $amount);
    }

    public function debit(MemberProfile $memberProfile, string $referenceType, int $referenceId, float $amount): MemberLedger
    {
        return $this->record($memberProfile, 'debit', $referenceType, $referenceId, $amount);
    }

    public function currentBalance(MemberProfile $memberProfile): float
    {
        return (float) ($memberProfile->ledgers()
            ->latest('id')
            ->value('balance_after') ?? 0);
    }

    public function recalcBalance(MemberProfile $memberProfile): float
    {
        $balance = $memberProfile->ledgers()
            ->orderBy('id')
            ->get()
            ->reduce(fn (float $carry, MemberLedger $ledger): float =>
                $carry + ($ledger->transaction_type === 'credit' ? $ledger->amount : -$ledger->amount),
                0.0
            );

        return (float) $balance;
    }

    private function record(
        MemberProfile $memberProfile,
        string $transactionType,
        string $referenceType,
        int $referenceId,
        float $amount
    ): MemberLedger {
        $lastLedger = $memberProfile->ledgers()
            ->lockForUpdate()
            ->latest('id')
            ->first();

        $currentBalance = (float) ($lastLedger?->balance_after ?? 0);
        $balanceAfter = $transactionType === 'credit'
            ? $currentBalance + $amount
            : $currentBalance - $amount;

        return MemberLedger::create([
            'tenant_id' => $memberProfile->tenant_id,
            'member_profile_id' => $memberProfile->id,
            'transaction_type' => $transactionType,
            'reference_type' => $referenceType,
            'reference_id' => $referenceId,
            'amount' => $amount,
            'balance_after' => $balanceAfter,
        ]);
    }
}
