<?php

namespace App\Enums;

enum Unit: string
{
    case Kilogram = 'kg';
    case Piece = 'pcs';

    public function label(): string
    {
        return match ($this) {
            self::Kilogram => 'Kilogram (kg)',
            self::Piece => 'Pcs',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())
            ->map(fn ($case) => [
                'value' => $case->value,
                'label' => $case->label(),
            ])
            ->all();
    }
}