<?php

namespace App\Services;

use App\Enums\TenantLedgerType;
use App\Models\TenantLedger;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class TenantLedgerService
{
    public function record(
        TenantLedgerType $type,
        Model $reference,
        float $debit = 0,
        float $credit = 0,
        ?string $description = null,
        ?int $createdBy = null,
    ): TenantLedger {

        $lastBalance = TenantLedger::query()
            ->latest('id')
            ->value('balance') ?? 0;

        $balance = $lastBalance + $credit - $debit;

        return TenantLedger::create([
            'type' => $type,

            'reference_type' => $reference::class,
            'reference_id' => $reference->getKey(),

            'description' => $description,

            'debit' => $debit,
            'credit' => $credit,
            'balance' => $balance,

            'created_by' => $createdBy ?? Auth::id(),
        ]);
    }
}