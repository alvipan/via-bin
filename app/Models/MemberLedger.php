<?php

namespace App\Models;

use App\Enums\MemberLedgerType;
use App\Models\Concerns\HasTenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class MemberLedger extends Model
{
    use HasTenant;
    
    protected $fillable = [
        'member_id',

        'type',

        'reference_type',
        'reference_id',

        'description',

        'debit',
        'credit',
        'balance',

        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'type' => MemberLedgerType::class,
            'debit' => 'decimal:2',
            'credit' => 'decimal:2',
            'balance' => 'decimal:2',
        ];
    }

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function reference(): MorphTo
    {
        return $this->morphTo();
    }

    public function amount(): float
    {
        return (float) ($this->credit ?: $this->debit);
    }

    public function isCredit(): bool
    {
        return $this->credit > 0;
    }

    public function isDebit(): bool
    {
        return $this->debit > 0;
    }
}