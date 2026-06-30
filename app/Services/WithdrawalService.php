<?php

namespace App\Services;

use App\Enums\MemberLedgerType;
use App\Enums\WithdrawalStatus;
use App\Models\Member;
use App\Models\MemberLedger;
use App\Models\Withdrawal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class WithdrawalService
{
    public function __construct(
        protected MemberLedgerService $memberLedgerService,
    ) {}

    public function create(array $data): Withdrawal
    {
        return DB::transaction(function () use ($data) {

            $member = Member::lockForUpdate()->findOrFail($data['member_id']);

            $amount = $data['amount'];

            if ($amount <= 0) {
                throw new RuntimeException('Nominal withdrawal tidak valid.');
            }

            if ($member->balance() < $amount) {
                throw new RuntimeException('Saldo member tidak mencukupi.');
            }

            $withdrawal = Withdrawal::create([
                'member_id'  => $member->id,
                'amount'     => $amount,
                'notes'      => $data['notes'] ?? null,
                'status'     => WithdrawalStatus::Posted,
                'posted_at'  => now(),
                'posted_by'  => Auth::id(),
                'created_by' => Auth::id(),
            ]);

            $ledger = $this->memberLedgerService->record(
                memberId: $withdrawal->member_id,
                type: MemberLedgerType::Withdrawal,
                reference: $withdrawal,
                debit: $withdrawal->amount,
                description: "Withdrawal #{$withdrawal->withdrawal_no}",
            );

            $withdrawal->member_ledger_id = $ledger->id;
            $withdrawal->save();

            return $withdrawal->fresh();
        });
    }
}