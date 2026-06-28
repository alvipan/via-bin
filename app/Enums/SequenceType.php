<?php

namespace App\Enums;

enum SequenceType: string
{
    case MEMBER = 'member';
    case DEPOSIT = 'deposit';
    case LOT = 'lot';
    case SALE = 'sale';
    case WITHDRAWAL = 'withdrawal';
}