<?php

namespace App\Enums;

enum WithdrawalStatus: string
{
    case Draft = 'draft';
    case Pending = 'pending';
    case Posted = 'posted';
    case Rejected = 'rejected';

    public function label(): string
    {
        return match ($this) {
            self::Draft => 'Draf',
            self::Pending => 'Ditunda',
            self::Posted => 'Dibukukan',
            self::Rejected => 'Ditolak',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Draft => 'zinc',
            self::Pending => 'amber',
            self::Posted => 'green',
            self::Rejected => 'red',
        };
    }
}