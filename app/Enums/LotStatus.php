<?php

namespace App\Enums;

enum LotStatus: string
{
    case Open = 'open';
    case Closed = 'closed';

    public function label(): string
    {
        return match ($this) {
            self::Open => 'Dibuka',
            self::Closed => 'Ditutup',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Open => 'green',
            self::Closed => 'zinc',
        };
    }

    public static function options(): array
    {
        return [
            self::Open,
            self::Closed,
        ];
    }
}