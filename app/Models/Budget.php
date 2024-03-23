<?php

namespace App\Models;

use App\Enums\BudgetType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Budget extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'description',
        'limit_value',
        'used_value',
        'type',
        'category_id'
    ];

    protected $casts = [
        'type' => BudgetType::class
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

}
