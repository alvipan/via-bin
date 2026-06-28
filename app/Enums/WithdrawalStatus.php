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
            self::Draft => 'Draft',
            self::Pending => 'Pending',
            self::Posted => 'Posted',
            self::Rejected => 'Rejected',
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