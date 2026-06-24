<?php

namespace App\Models;

use App\Models\Concerns\HasTenant;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['tenant_id', 'user_id', 'member_number', 'address', 'status'])]
class MemberProfile extends Model
{
    use HasFactory, HasTenant;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function deposits(): HasMany
    {
        return $this->hasMany(Deposit::class);
    }

    public function lots(): HasMany
    {
        return $this->hasMany(Lot::class);
    }

    public function saleAllocations(): HasMany
    {
        return $this->hasMany(SaleAllocation::class);
    }

    public function ledgers(): HasMany
    {
        return $this->hasMany(MemberLedger::class);
    }

    public function withdrawals(): HasMany
    {
        return $this->hasMany(Withdrawal::class);
    }

    public function balance(): float
    {
        return (float) $this->ledgers()->latest('id')->value('balance_after') ?? 0;
    }
}
