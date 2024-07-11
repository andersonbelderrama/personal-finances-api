<?php

namespace App\Models;

use App\Enums\TransactionType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
      use HasFactory;


      protected $fillable = [
            'name',
            'description',
            'value',
            'payment_date',
            'due_date',
            'type',
            'is_paid',
            'category_id',
            'account_id'
      ];

      protected $casts = [
            'is_paid' => 'boolean',
            'type' => TransactionType::class
      ];

      protected $dates = [
            'payment_date',
            'due_date'
      ];

      public function category(): BelongsTo
      {
            return $this->belongsTo(Category::class);
      }

      public function account(): BelongsTo
      {
            return $this->belongsTo(Account::class);
      }

      public function scopeMinValue(Builder $query, $value)
      {
            return $query->where('value', '>=', $value);
      }

      public function scopeMaxValue(Builder $query, $value)
      {
            return $query->where('value', '<=', $value);
      }
}
