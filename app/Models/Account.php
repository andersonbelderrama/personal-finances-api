<?php

namespace App\Models;

use App\Enums\AccountType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'branch',
        'account_number',
        'active',
        'type',
        'balance',
        'user_id',
    ];

    protected $casts = [
        'active' => 'boolean',
        'type' => AccountType::class,
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];


    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function transactions() : HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function recurrentExpenses() : HasMany
    {
        return $this->hasMany(RecurrentExpense::class);
    }

    public function scopeMinBalance(Builder $query, $value)
    {
        return $query->where('balance', '>=', $value);
    }

    public function scopeMaxBalance(Builder $query, $value)
    {
        return $query->where('balance', '<=', $value);
    }

}
