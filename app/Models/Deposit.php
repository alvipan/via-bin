<?php

namespace App\Models;

use App\Models\Concerns\HasTenant;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Fillable(['tenant_id', 'member_profile_id', 'waste_category_id', 'created_by', 'reference_number', 'quantity', 'unit_price', 'subtotal', 'deposited_at'])]
class Deposit extends Model
{
    use HasFactory, HasTenant;

    protected function casts(): array
    {
        return [
            'quantity' => 'decimal:3',
            'unit_price' => 'decimal:2',
            'subtotal' => 'decimal:2',
            'deposited_at' => 'datetime',
        ];
    }

    public function memberProfile(): BelongsTo
    {
        return $this->belongsTo(MemberProfile::class);
    }

    public function wasteCategory(): BelongsTo
    {
        return $this->belongsTo(WasteCategory::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function lot(): HasOne
    {
        return $this->hasOne(Lot::class);
    }

    public function totalValue(): float
    {
        return (float) $this->quantity * (float) $this->unit_price;
    }
}
