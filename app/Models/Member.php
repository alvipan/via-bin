<?php

namespace App\Models;

use App\Enums\SequenceType;
use App\Models\Concerns\HasTenant;
use App\Services\SequenceService;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Builder;

class Member extends Authenticatable
{
    use HasTenant, Notifiable;

    protected $fillable = [
        'tenant_id',
        'member_code',
        'name',
        'phone',
        'address',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Member $member) {

            $member->member_code = SequenceService::nextCode(
                tenantId: $member->tenant_id,
                type: SequenceType::Member->value,
                prefix: 'MB',
            );
        });
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function ledgers()
    {
        return $this->hasMany(MemberLedger::class);
    }

    public function lots()
    {
        return $this->hasMany(Lot::class);
    }

    public function balance(): float
    {
        return (float) $this->ledgers()
            ->latest('id')
            ->value('balance') ?? 0;
    }

    public function scopeSearch(Builder $query, ?string $search): Builder
    {
        return $query->when($search, function (Builder $query) use ($search) {
            $query->where(function (Builder $query) use ($search) {
                $query->where('member_code', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        });
    }
}