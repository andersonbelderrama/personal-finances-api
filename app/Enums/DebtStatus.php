<?php

namespace App\Enums;

enum DebtStatus: int
{
    case PENDING = 1;
    CASE PROGRESS = 2;
    CASE PAID = 3;


    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'Pendente',
            self::PROGRESS => 'Em Andamento',
            self::PAID => 'Quitado',
        };
    }
}
