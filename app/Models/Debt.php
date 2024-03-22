<?php

namespace App\Models;

use App\Enums\DebtPaymentMethod;
use App\Enums\DebtPriority;
use App\Enums\DebtStatus;
use Database\Factories\DebtFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Debt extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'priority',
        'debt_value',
        'negotiated_value',
        'paid_value',
        'payment_date',
        'due_date',
        'payment_method',
        'installments',
        'status',
    ];

    protected $casts = [
        'priority' => DebtPriority::class,
        'status' => DebtStatus::class,
        'payment_method' => DebtPaymentMethod::class,
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'payment_date',
        'due_date',
    ];

    public function transactions() : BelongsToMany
    {
        return $this->belongsToMany(Transaction::class, 'transaction_debts');
    }

    public function notes(): MorphMany
    {
        return $this->morphMany(Note::class, 'entity');
    }

    public function addNote($note)
    {
        $this->notes()->create([
            'note' => $note,
        ]);
    }

}
