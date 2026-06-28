<?php

namespace App\Enums;

enum MemberLedgerType: string
{
    case Sale = 'sale';
    case Withdrawal = 'withdrawal';
    case Adjustment = 'adjustment';

    public function label(): string
    {
        return match ($this) {
            self::Sale => 'Penjualan',
            self::Withdrawal => 'Penarikan',
            self::Adjustment => 'Penyesuaian',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Sale => 'green',
            self::Withdrawal => 'red',
            self::Adjustment => 'zinc',
        };
    }
}