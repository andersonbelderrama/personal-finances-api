<?php

namespace App\Enums;

enum DebtPriority: int
{
    case Low = 1;
    case Medium = 2;
    case High = 3;
    case Urgent = 4;

    public function label(): string
    {
        return match ($this) {
            self::Low => 'Baixa',
            self::Medium => 'Média',
            self::High => 'Alta',
            self::Urgent => 'Urgente',
        };
    }
}
