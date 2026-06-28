<?php

namespace App\Models;

use App\Models\Concerns\HasTenant;
use Illuminate\Database\Eloquent\Model;

class Sequence extends Model
{
    use HasTenant;

    protected $fillable = [
        'tenant_id',
        'type',
        'next_number',
    ];

    protected function casts(): array
    {
        return [
            'next_number' => 'integer',
        ];
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}