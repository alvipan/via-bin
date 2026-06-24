<?php

namespace App\Models;

use App\Models\Concerns\HasTenant;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['tenant_id', 'deposit_id', 'member_profile_id', 'waste_category_id', 'lot_number', 'initial_quantity', 'remaining_quantity', 'status'])]
class Lot extends Model
{
    use HasFactory, HasTenant;

    protected function casts(): array
    {
        return [
            'initial_quantity' => 'decimal:3',
            'remaining_quantity' => 'decimal:3',
        ];
    }

    public function deposit(): BelongsTo
    {
        return $this->belongsTo(Deposit::class);
    }

    public function memberProfile(): BelongsTo
    {
        return $this->belongsTo(MemberProfile::class);
    }

    public function wasteCategory(): BelongsTo
    {
        return $this->belongsTo(WasteCategory::class);
    }

    public function saleAllocations(): HasMany
    {
        return $this->hasMany(SaleAllocation::class);
    }

    public function isAvailable(): bool
    {
        return (float) $this->remaining_quantity > 0 && in_array($this->status, ['available', 'partial'], true);
    }
}
