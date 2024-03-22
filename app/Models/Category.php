<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description'
    ];

    public function budget() : HasOne
    {
        return $this->hasOne(Budget::class);
    }

    public function transactions() : HasMany
    {
        return $this->hasMany(Transaction::class);
    }


}
