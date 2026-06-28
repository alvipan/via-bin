<?php

namespace App\Models;

use App\Models\Concerns\HasTenant;
use Illuminate\Database\Eloquent\Model;

class TenantSetting extends Model
{
    use HasTenant;
    
    protected $fillable = [
        'tenant_id',
        'operational_fee_percent',
    ];

    protected function casts(): array
    {
        return [
            'operational_fee_percent' => 'decimal:2',
        ];
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}