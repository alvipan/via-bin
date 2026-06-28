<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;

#[Fillable(['name', 'slug', 'status'])]
class Tenant extends Model
{
    use HasFactory;

    public function tenantUsers(): HasMany
    {
        return $this->hasMany(TenantUser::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'tenant_users')
            ->withPivot(['id', 'role', 'status'])
            ->withTimestamps();
    }

    public function members(): HasMany
    {
        return $this->hasMany(Member::class);
    }

    public function wasteTypes(): HasMany
    {
        return $this->hasMany(WasteType::class);
    }

    public function deposits(): HasMany
    {
        return $this->hasMany(Deposit::class);
    }

    public function lots(): HasMany
    {
        return $this->hasMany(Lot::class);
    }

    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class);
    }

    public function withdrawals(): HasMany
    {
        return $this->hasMany(Withdrawal::class);
    }

    public function setting(): HasOne
    {
        return $this->hasOne(TenantSetting::class);
    }

    protected static function booted(): void
    {
        static::creating(function (Tenant $tenant) {
            if ($tenant->tenant_code) {
                return;
            }

            $next = DB::transaction(function () {
                $last = self::query()
                    ->lockForUpdate()
                    ->max(DB::raw('CAST(SUBSTRING(tenant_code, 3) AS UNSIGNED)'));

                return ($last ?? 0) + 1;
            });

            $tenant->tenant_code = 'BS' . str_pad($next, 4, '0', STR_PAD_LEFT);
        });

        static::created(function (Tenant $tenant) {
            $tenant->setting()->create();
        });
    }
}