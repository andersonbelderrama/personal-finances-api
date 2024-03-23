<?php

namespace App\Models;

use App\Enums\RecurrentFrequency;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RecurrentExpense extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'value',
        'is_paid',
        'is_active',
        'recurrent_date',
        'recurrence_frequency',
        'category_id',
        'account_id',
    ];

    protected $casts = [
        'is_paid' => 'boolean',
        'is_active' => 'boolean',
        'recurrence_frequency' => RecurrentFrequency::class,
    ];

    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function account() : BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    public function transactions() : BelongsToMany
    {
        return $this->belongsToMany(Transaction::class, 'transaction_recurrent_expenses');
    }

}
