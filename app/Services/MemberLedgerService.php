<?php

namespace App\Services;

use App\Enums\MemberLedgerType;
use App\Models\MemberLedger;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class MemberLedgerService
{
    public function record(
        int $memberId,
        MemberLedgerType $type,
        Model $reference,
        float $debit = 0,
        float $credit = 0,
        ?string $description = null,
        ?int $createdBy = null,
    ): MemberLedger {

        $lastBalance = MemberLedger::query()
            ->where('member_id', $memberId)
            ->latest('id')
            ->value('balance') ?? 0;

        $balance = $lastBalance + $credit - $debit;

        return MemberLedger::create([
            'member_id'      => $memberId,

            'type'           => $type,

            'reference_type' => $reference::class,
            'reference_id'   => $reference->getKey(),

            'description'    => $description,

            'debit'          => $debit,
            'credit'         => $credit,
            'balance'        => $balance,

            'created_by'     => $createdBy ?? Auth::id(),
        ]);
    }
}