<?php

namespace App\Services;

use App\Models\MemberProfile;
use App\Models\Withdrawal;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use App\Services\LedgerService;

class WithdrawalService
{
    public function __construct(
        private readonly LedgerService $ledgerService,
    ) {}

    /**
     * @param  array{
     *     member_profile_id:int,
     *     approved_by?:int|null,
     *     reference_number?:string,
     *     amount:float,
     *     status?:string
     * }  $data
     */
    public function create(array $data): Withdrawal
    {
        return DB::transaction(function () use ($data): Withdrawal {
            $memberProfile = MemberProfile::query()->lockForUpdate()->findOrFail($data['member_profile_id']);
            $amount = (float) $data['amount'];

            if ($this->ledgerService->currentBalance($memberProfile) < $amount) {
                throw ValidationException::withMessages([
                    'amount' => 'Withdrawal amount exceeds member balance.',
                ]);
            }

            $withdrawal = Withdrawal::create([
                'tenant_id' => $memberProfile->tenant_id,
                'member_profile_id' => $memberProfile->id,
                'approved_by' => $data['approved_by'] ?? null,
                'reference_number' => $data['reference_number'] ?? $this->makeReferenceNumber(),
                'amount' => $amount,
                'status' => $data['status'] ?? 'approved',
            ]);

            if ($withdrawal->status === 'approved') {
                $this->ledgerService->debit($memberProfile, Withdrawal::class, $withdrawal->id, $amount);
            }

            return $withdrawal->load('memberProfile');
        });
    }

    public function approve(Withdrawal $withdrawal, int $approvedBy): Withdrawal
    {
        if ($withdrawal->status !== 'pending') {
            return $withdrawal;
        }

        return DB::transaction(function () use ($withdrawal, $approvedBy): Withdrawal {
            $memberProfile = MemberProfile::query()->lockForUpdate()->findOrFail($withdrawal->member_profile_id);
            $amount = (float) $withdrawal->amount;

            if ($this->ledgerService->currentBalance($memberProfile) < $amount) {
                throw ValidationException::withMessages([
                    'amount' => 'Withdrawal amount exceeds member balance.',
                ]);
            }

            $withdrawal->update([
                'approved_by' => $approvedBy,
                'status' => 'approved',
            ]);

            $this->ledgerService->debit($memberProfile, Withdrawal::class, $withdrawal->id, $amount);

            return $withdrawal->refresh();
        });
    }

    private function makeReferenceNumber(): string
    {
        return 'WDR-'.now()->format('YmdHis');
    }
}
