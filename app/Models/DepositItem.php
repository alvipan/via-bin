<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DepositItem extends Model
{
    protected $fillable = [
        'deposit_id',
        'waste_type_id',
        'quantity',
    ];

    protected function casts(): array
    {
        return [
            'quantity' => 'decimal:3',
        ];
    }

    public function deposit(): BelongsTo
    {
        return $this->belongsTo(Deposit::class);
    }

    public function wasteType(): BelongsTo
    {
        return $this->belongsTo(WasteType::class);
    }

    public function lot(): HasOne
    {
        return $this->hasOne(Lot::class);
    }
}