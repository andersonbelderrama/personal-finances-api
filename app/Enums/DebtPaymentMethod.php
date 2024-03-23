<?php

namespace App\Enums;

enum DebtPaymentMethod: int
{
    case CASH = 1;
    case INSTALLMENT = 2;
    case REFINANCED = 3;


    public function label(): string
    {
        return match ($this) {
            self::CASH => 'A Vista',
            self::INSTALLMENT => 'Parcelado',
            self::REFINANCED => 'Refinanciado',
        };
    }
}
