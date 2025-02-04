<?php

namespace App\Enums;

enum TransactionType: int
{
      case INCOME = 1;
      case EXPENSE = 2;
      case TRANSFER = 3;




      public function label(): string
      {
            return match ($this) {
                  self::INCOME => 'Receita',
                  self::EXPENSE => 'Despesa',
                  self::TRANSFER => 'Transferência',
            };
      }

      public static function fromLabel(string $label): self|null
      {
            return match ($label) {
                  'Receita' => self::INCOME,
                  'Despesa' => self::EXPENSE,
                  'Transferência' => self::TRANSFER,
                  default => null
            };
      }
}
