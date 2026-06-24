<?php

namespace App\Services;

use App\Models\OperationalTransaction;

class OperationalTransactionService
{
    public function recordRevenue(int $tenantId, int $createdBy, float $amount, string $description, string $transactionType = 'sale'): OperationalTransaction
    {
        return OperationalTransaction::create([
            'tenant_id' => $tenantId,
            'created_by' => $createdBy,
            'transaction_type' => $transactionType,
            'amount' => $amount,
            'transaction_date' => now()->toDateString(),
            'description' => $description,
        ]);
    }
}
