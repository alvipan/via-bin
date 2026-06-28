<?php

namespace App\Models;

use App\Enums\Unit;
use App\Models\Concerns\HasTenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WasteType extends Model
{
    use HasTenant;
    
    protected $fillable = [
        'tenant_id',
        'name',
        'unit',
        'estimated_price',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'unit' => Unit::class,
            'estimated_price' => 'decimal:2',
            'is_active' => 'boolean',
        ];
    }

    public function depositItems(): HasMany
    {
        return $this->hasMany(DepositItem::class);
    }

}