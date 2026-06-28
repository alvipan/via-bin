<?php

namespace App\Enums;

enum TenantModule: string
{
    case Dashboard = 'dashboard';
    case Members = 'members';
    case WasteTypes = 'waste_types';
    case Deposits = 'deposits';
    case Lots = 'lots';
    case Sales = 'sales';
    case Withdrawals = 'withdrawals';
    case Settings = 'settings';
    case Users = 'users';
}