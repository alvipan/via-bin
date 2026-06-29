<?php

namespace App\Models;

use App\Enums\SequenceType;
use App\Enums\WithdrawalStatus;
use App\Models\Concerns\HasTenant;
use App\Services\SequenceService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Withdrawal extends Model
{
    use HasTenant;

    protected $fillable = [
        'member_id',
        'amount',
        'notes',
        'status',
        'posted_at',
        'posted_by',
        'member_ledger_id',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'status' => WithdrawalStatus::class,
            'posted_at' => 'datetime',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Withdrawal $withdrawal): void {

            $withdrawal->withdrawal_no = SequenceService::nextCode(
                tenantId: $withdrawal->tenant_id,
                type: SequenceType::WITHDRAWAL->value,
                prefix: 'WD',
            );
        });
    }

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    public function ledger(): BelongsTo
    {
        return $this->belongsTo(MemberLedger::class, 'member_ledger_id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function poster(): BelongsTo
    {
        return $this->belongsTo(User::class, 'posted_by');
    }

    public function isDraft(): bool
    {
        return $this->status === WithdrawalStatus::Draft;
    }

    public function isPending(): bool
    {
        return $this->status === WithdrawalStatus::Pending;
    }

    public function isPosted(): bool
    {
        return $this->status === WithdrawalStatus::Posted;
    }

    public function isRejected(): bool
    {
        return $this->status === WithdrawalStatus::Rejected;
    }

    public function canPost(): bool
    {
        return $this->isDraft() || $this->isPending();
    }

    public function canEdit(): bool
    {
        return ! $this->isPosted();
    }

    public function canDelete(): bool
    {
        return ! $this->isPosted();
    }
}