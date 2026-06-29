<?php

namespace App\Models;

use App\Enums\SequenceType;
use App\Enums\LotStatus;
use App\Models\Concerns\HasTenant;
use App\Services\SequenceService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lot extends Model
{
    use HasTenant;
    
    protected $fillable = [
        'tenant_id',
        'lot_no',
        'member_id',
        'deposit_item_id',
        'quantity_received',
        'quantity_remaining',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'quantity_received' => 'decimal:3',
            'quantity_remaining' => 'decimal:3',
            'status' => LotStatus::class,
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Lot $lot) {
            $lot->lot_no = SequenceService::nextCode(
                tenantId: $lot->tenant_id,
                type: SequenceType::Lot->value,
                prefix: 'LT',
            );
        });
    }

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    public function getDepositAttribute(): Deposit
    {
        return $this->depositItem->deposit;
    }

    public function getWasteTypeAttribute(): WasteType
    {
        return $this->depositItem->wasteType;
    }

    public function getEstimatedIncomeAttribute(): float
    {
        return (float) $this->quantity_remaining
            * (float) ($this->wasteType?->estimated_price ?? 0);
    }

    public function depositItem(): BelongsTo
    {
        return $this->belongsTo(DepositItem::class);
    }

    public function saleItemLots()
    {
        return $this->hasMany(SaleItemLot::class);
    }

    public function reduceQuantity(float $quantity): void
    {
        $remaining = max(0, (float) $this->quantity_remaining - $quantity);

        $this->update([
            'quantity_remaining' => $remaining,
            'status' => $remaining > 0
                ? LotStatus::Open
                : LotStatus::Closed,
        ]);
    }

    public static function availableStock(int $tenantId, int $wasteTypeId): float
    {
        return static::query()
            ->where('tenant_id', $tenantId)
            ->whereHas('depositItem', function ($q) use ($wasteTypeId) {
                $q->where('waste_type_id', $wasteTypeId);
            })
            ->where('quantity_remaining', '>', 0)
            ->sum('quantity_remaining');
    }

    public function getQuantitySoldAttribute(): float
    {
        return $this->quantity_received - $this->quantity_remaining;
    }

    public function getUnitAttribute(): string
    {
        return $this->depositItem->wasteType->unit->value;
    }

    public function getWasteTypeNameAttribute(): string
    {
        return $this->depositItem->wasteType->name;
    }

    public function getDepositNoAttribute(): string
    {
        return $this->depositItem->deposit->deposit_no;
    }

    public function getRouteKeyName(): string
    {
        return 'lot_no';
    }

    public function scopeSearch($query, ?string $search)
    {
        if (blank($search)) {
            return;
        }

        $query->where(function ($query) use ($search) {
            $query->where('lot_no', 'like', "%{$search}%")
                ->orWhereHas('member', function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('member_code', 'like', "%{$search}%");
                })
                ->orWhereHas('depositItem.wasteType', function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%");
                });
        });
    }

    public function scopeMember(
        Builder $query,
        Member|int $member,
    ): Builder {
        return $query->where(
            'member_id',
            $member instanceof Member
                ? $member->id
                : $member,
        );
    }

    public function scopeOpen(Builder $query): Builder
    {
        return $query->where('status', LotStatus::Open);
    }
}