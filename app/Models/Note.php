<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'entity_id',
        'entity_type',
        'note'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

}
