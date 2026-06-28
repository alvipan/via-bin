<?php

namespace App\Models;

use App\Enums\DepositStatus;
use App\Models\Concerns\HasTenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Deposit extends Model
{
    use HasTenant;
    
    public const DRAFT = 'draft';
    public const POSTED = 'posted';
    public const CANCELLED = 'cancelled';

    protected $fillable = [
        'tenant_id',
        'member_id',
        'deposit_no',
        'posted_at',
        'status',
        'notes',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'status' => DepositStatus::class,
            'posted_at' => 'datetime',
        ];
    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(DepositItem::class);
    }

    public function isDraft(): bool
    {
        return $this->status === DepositStatus::Draft;
    }

    public function isPosted(): bool
    {
        return $this->status === DepositStatus::Posted;
    }

    public function isCancelled(): bool
    {
        return $this->status === DepositStatus::Cancelled;
    }

    public function getRouteKeyName(): string
    {
        return 'deposit_no';
    }
}