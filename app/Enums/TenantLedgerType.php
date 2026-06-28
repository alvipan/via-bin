<?php

namespace App\Enums;

enum TenantLedgerType: string
{
    case SaleIncome = 'sale_income';

    case OperationalIncome = 'operational_income';

    case OperationalExpense = 'operational_expense';

    case Adjustment = 'adjustment';

    public function label(): string
    {
        return match ($this) {
            self::SaleIncome => 'Pendapatan Penjualan',
            self::OperationalIncome => 'Pendapatan Operasional',
            self::OperationalExpense => 'Biaya Operasional',
            self::Adjustment => 'Penyesuaian',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::SaleIncome => 'green',
            self::OperationalIncome => 'emerald',
            self::OperationalExpense => 'red',
            self::Adjustment => 'zinc',
        };
    }
}