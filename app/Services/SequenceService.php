<?php

namespace App\Services;

use App\Models\Sequence;
use Illuminate\Support\Facades\DB;

class SequenceService
{
    public static function next(
        int $tenantId,
        string $type
    ): int {
        return DB::transaction(function () use (
            $tenantId,
            $type
        ) {

            $sequence = Sequence::query()
                ->lockForUpdate()
                ->firstOrCreate(
                    [
                        'tenant_id' => $tenantId,
                        'type' => $type,
                    ],
                    [
                        'next_number' => 1,
                    ]
                );

            $number = $sequence->next_number;

            $sequence->increment('next_number');

            return $number;
        });
    }

    public static function nextCode(
        int $tenantId,
        string $type,
        string $prefix,
        int $padding = 3,
    ): string {
        $number = self::next($tenantId, $type);

        return $prefix . str_pad(
            $number,
            $padding,
            '0',
            STR_PAD_LEFT
        );
    }
}