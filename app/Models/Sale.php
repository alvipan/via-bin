<?php

namespace App\Models;

use App\Enums\SaleStatus;
use App\Models\Concerns\HasTenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sale extends Model
{
    use HasTenant;
    
    protected $fillable = [
        'tenant_id',
        'sale_no',
        'sale_date',

        'gross_amount',
        'operational_percent',
        'operational_amount',
        'net_amount',

        'status',
        'notes',

        'posted_by',
        'posted_at',

        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'sale_date' => 'date',

            'gross_amount' => 'decimal:2',
            'operational_percent' => 'decimal:2',
            'operational_amount' => 'decimal:2',
            'net_amount' => 'decimal:2',

            'posted_at' => 'datetime',

            'status' => SaleStatus::class,
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'sale_no';
    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(SaleItem::class);
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
        return $this->status === SaleStatus::Draft;
    }

    public function isPosted(): bool
    {
        return $this->status === SaleStatus::Posted;
    }

    public function scopeDraft($query)
    {
        return $query->where('status', SaleStatus::Draft);
    }

    public function scopePosted($query)
    {
        return $query->where('status', SaleStatus::Posted);
    }

}