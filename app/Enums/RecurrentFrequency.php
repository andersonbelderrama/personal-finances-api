<?php

namespace App\Enums;

enum RecurrentFrequency: int
{
    case DAILY = 1;
    case WEEKLY = 2;
    case MONTHLY = 3;
    case YEARLY = 4;


    public function label(): string
    {
        return match ($this) {
            self::DAILY => 'Diário',
            self::WEEKLY => 'Semanal',
            self::MONTHLY => 'Mensal',
            self::YEARLY => 'Anual',
        };
    }
}
