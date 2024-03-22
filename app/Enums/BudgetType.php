<?php

namespace App\Enums;

enum BudgetType: int
{
    case DAILY = 1;
    case MONTHLY = 2;
    case YEARLY = 3;



    public function label(): string
    {
        return match ($this) {
            self::DAILY => 'Diario',
            self::MONTHLY => 'Mensal',
            self::YEARLY => 'Anual',
        };
    }
}
