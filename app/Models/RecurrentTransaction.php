<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RecurrentTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'value',
        'type',
        'is_paid',
        'recurrent_date',
        'recurrence_frequency',
        'category_id',
        'account_id',
    ];

    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function account() : BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    public function transactions() : HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
