<?php

namespace App\Enums;

enum SequenceType: string
{
    case Member = 'member';
    case Deposit = 'deposit';
    case Lot = 'lot';
    case Sale = 'sale';
    case WITHDRAWAL = 'withdrawal';
}