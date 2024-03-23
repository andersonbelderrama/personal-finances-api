<?php

namespace App\Enums;

enum AccountType: int
{
    case ContaCorrente = 1;
    case ContaPoupanca = 2;
    case ContaInvestimento = 3;

    public function label(): string
    {
        return match ($this) {
            self::ContaCorrente => 'Conta Corrente',
            self::ContaPoupanca => 'Conta Poupança',
            self::ContaInvestimento => 'Conta Investimento',
        };
    }
}
